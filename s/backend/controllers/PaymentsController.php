<?php

namespace backend\controllers;

use Yii;
use common\models\Payments;
use common\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\User;

/**
 * PaymentsController implements the CRUD actions for Survey model.
 */
class PaymentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
/*            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],*/
			'access' => [
                'class' => AccessControl::className(),
                'rules' => [
					[
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'pay'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
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
		
		$searchModel->user_id = Yii::$app->request->get('user_id'); // zyx
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //kbb 02.03.22 2:45
        $dataProvider->query->addOrderBy('status ASC, id DESC');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('index', [
            'model' => $this->findModel($id),
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

		$model->created_at = time();
     	$model->updated_at = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

      	$model->updated_at = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = Survey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPay($payment_id)
    {
		$payment = Payments::findOne([
			'id' => $payment_id,
		]);

        //kbb 06.02.22 6:39
        $messageLog = [
            'status' => 'Платеж до изменения',
            'payment' => $payment
        ];
        Yii::info($messageLog, 'process');

		$payment->status = 1;
		if($payment->save()) {
            //kbb 06.02.22 6:39
            $messageLog = [
                'status' => 'Статус платежа изменен ',
                'payment' => $payment
            ];
            Yii::info($messageLog, 'process');

			$user = User::findOne($payment->user_id);
			$user->can_left = 1;
            //kbb 11.01.2022 10:34
            $user->can_right = 1;

			if ($user->save()) {
                //kbb 06.02.22 6:39
                $messageLog = [
                    'status' => 'Пользователь обновлен',
                    '$user' => $user
                ];
                Yii::info($messageLog, 'process');
            } else {
                //kbb 06.02.22 6:39
                $messageLog = [
                    'status' => 'Ошибка сохранения пользователя',
                    'error' => $user->getErrors()
                ];
                Yii::info($messageLog, 'process');
            }
			User::findplace($payment->user_id);
		} else {
            //kbb 06.02.22 6:39
            $messageLog = [
                'status' => 'Ошибка сохранения платежа',
                'error' => $payment->getErrors()
            ];
            Yii::info($messageLog, 'process');
        }
			
        return $this->redirect(['payments/index']);

        //03.02.22 2:19

//        $page = Yii::app()->getRequest()->getParam('current_page',1);
//        $params = $page? array('current_page'=>$page) : array();
//        $route = Yii::$app->urlManager->createUrl('current_page',$params);
//        $this->redirect($route,true);

//        return $this->redirect(['index']);
    }

	

	
}
