<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\LoginForm;
use common\models\Payments;
use common\models\User;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    //kbb 30.12.21 21:55 
    public function actionMaintenance() {
        // echo "<h1>Сайт находится на обслуживании...</h1>";
        return $this->render('maitenance');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                   /* [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	/**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if ( Yii::$app->request->get('rid') )	{
				$_SESSION['rid'] = Yii::$app->request->get('rid');

				//var_dump($_SESSION);
		}
		
		if (!Yii::$app->user->isGuest) {
            return $this->redirect(['user/index']);
        }

		$model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {

            //kbb 06.02.22 6:07
            $messageLog = [
                'status' => 'Подготовленные данные для создания пользователя',
                'model' => $model
            ];
            Yii::info($messageLog, 'process');

            if ($user = $model->signup()) {
              //  if (Yii::$app->getUser()->login($user[0])) {

                    //kbb 06.02.22 6:07
                    $messageLog = [
                        'status' => 'Создание пользователя успешно',
                        'user' => $user
                    ];
                    Yii::info($messageLog, 'process');

					Yii::$app->mailer->compose()
						->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
						->setTo($user[0]->email)
						->setSubject('Успешная регистрация - ' . Yii::$app->name)
						->setTextBody('Поздравляем с успешной регистрацией на сайте Marqar.biz!
Для входа на сайт пожалуйста, используйте следующие данные:
Логин: '.$user[0]->email.'
Пароль: '.$user[1].'
')
    					->setHtmlBody('<p><b>Поздравляем с успешной регистрацией на сайте <a href="http://marqar.kz">Marqar.biz</a>!</b></p>
                        <p>Для входа на сайт пожалуйста, используйте следующие данные:<br>
                        Логин: '.$user[0]->email.'<br>
                        Пароль: '.$user[1].'<br>
                        </p>
                        ')
						->send();
					
                    Payments::createstartpayment($user[0]->id);
                    //kbb 06.02.22 6:32
//                    User::allcoditions($user[0]->ref_id);

                    //kbb 31.01.22 2:58
                   Yii::$app->session->setFlash('info', 'Ваш Агентский номер со ссылками для входа в личный кабинет отправлен на Вашу электронную почту');

                   return $this->redirect(['user/index']);
               // }
            }
            else {
                Yii::$app->session->setFlash('error', 'Ошибка регистрации. Обратитесь к администрации сайта.');

                //kbb 06.02.22 6:07
                $messageLog = [
                    'status' => 'Ошибка при создание пользователя',
                    'user' => $user
                ];
                Yii::info($messageLog, 'process');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['user/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['user/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        // return Yii::$app
        //     ->mailer
        //     ->compose()
        //     ->setFrom(['admin@marqar.kz'])
        //     ->setTo('bernur@mail.ru')
        //     ->setSubject('test')
        //     ->send();
                    
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте ваш email. На него были высланы данные для сброса пароля.');

                return $this->redirect(['site/login']);
            } else {
                Yii::$app->session->setFlash('error', 'Выслать данные не получилось.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->redirect(['site/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
