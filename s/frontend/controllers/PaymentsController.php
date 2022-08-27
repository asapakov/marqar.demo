<?php

namespace frontend\controllers;

use Yii;
use common\models\Payments;
use common\models\User;
use common\models\Earnings;
use common\models\Withdrawals;
use common\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class PaymentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
		
		$searchModel->user_id =  Yii::$app->user->identity->id; // zyx
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	/**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();
		
		$model->user_id =  Yii::$app->user->identity->id;
		$model->created_at = time();
     	$model->updated_at = time();
		$model->status = 0;
		$model->description = 'Plan '.Yii::$app->request->get()['plan'];
		
		if (isset(Yii::$app->request->post()['Payments']['amount'])) {
			switch(Yii::$app->request->get()['plan'])	{
				case 1:
					if (Yii::$app->request->post()['Payments']['amount'] < 20)	{
						Yii::$app->session->setFlash('error', 'Your payment is too small for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
					if (Yii::$app->request->post()['Payments']['amount'] > 2000)	{
						Yii::$app->session->setFlash('error', 'Your payment is too big for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
						
					break;
				case 2:
					if (Yii::$app->request->post()['Payments']['amount'] < 20)	{
						Yii::$app->session->setFlash('error', 'Your payment is too small for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
					if (Yii::$app->request->post()['Payments']['amount'] > 6000)	{
						Yii::$app->session->setFlash('error', 'Your payment is too big for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
					
					break;
				case 3:
					if (Yii::$app->request->post()['Payments']['amount'] < 20)	{
						Yii::$app->session->setFlash('error', 'Your payment is too small for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
					if (Yii::$app->request->post()['Payments']['amount'] > 30000)	{
						Yii::$app->session->setFlash('error', 'Your payment is too big for this plan');
						return $this->redirect(['payments/create', 'plan' => Yii::$app->request->get()['plan']]);
					}
					
					break;
			}
		}
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if ($model->type == 0)
            	return $this->redirect(['perfectmoney', 'id' => $model->id]);
			if ($model->type == 1)
            	return $this->redirect(['payeer', 'id' => $model->id]);
			if ($model->type == 2)
            	return $this->redirect(['advcash', 'id' => $model->id]);
			if ($model->type == 3)
            	return $this->redirect(['bitcoin', 'id' => $model->id]);
        }

        return $this->render('create', [
           'model' => $model,
        ]);
    }

    /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Survey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
	}

	

	public function actionPay($payment_id)
    {
		$payment = Payments::findOne([
			'id' => $payment_id,
			'user_id' => Yii::$app->user->identity->id,
		]);	


		// $merchant = Yii::$app->get('robokassa');
        //     return $merchant->payment(new \robokassa\PaymentOptions([
        //         'outSum' => 100,
        //         'description' => 'Пополнение счета',
        //         // 'incCurrLabel' => '',
        //         'invId' => $model->id,
        //         'culture' => 'ru',
        //         'encoding' => Yii::$app->charset,
        //         'email' => Yii::$app->user->identity->email,
        //         // 'expirationDate' => '', // ISO 8601 (YYYY-MM-DDThh:mm:ss.fffffffZZZZZ)
        //         // 'outSumCurrency' => 'USD',
        //         'userIP' => Yii::$app->request->userIP,
        //         // Дополнительные пользовательские параметры (shp_)
        //         'params' => [
        //             'user_id' => 1,
        //             'login' => 'user1',
        //         ],
        //     ]));

		// $payment->status = 1;
		// if($payment->save()) {
		// 	$user = User::findOne($payment->user_id);
		// 	$user->can_left = 1;

		// 	$user->save();

			
		// 	User::findplace($payment->user_id);
		// }
			

        // return $this->redirect(['user/index']);
    }

}
