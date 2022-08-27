<?php

namespace frontend\controllers;

use Yii;
use common\models\Withdrawals;
use common\models\WithdrawalsSearch;
use yii\web\Controller;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * WithdrawalsController implements the CRUD actions for Surveys model.
 */
class WithdrawalsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@']
                    ]
                ]
            ],
			'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Withdrawals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WithdrawalsSearch();
		
		$searchModel->user_id =  Yii::$app->user->identity->id; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Withdrawals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		$withdrawal_amount = Yii::$app->request->post()['amount']; 
		
		if( is_numeric($withdrawal_amount) )	{
		
			$model = new Withdrawals();
			
				$model->user_id = Yii::$app->user->identity->id;
				$model->amount = $withdrawal_amount;
//				$model->description = 'Запрос от пользователя';
//				$model->type = 1;
                //kbb 02.03.22 2:00
				$model->type = Yii::$app->request->post()['type'];

				if ($model->type == 30) {
                    $model->description = 'Запрос АВ от пользователя';
                } else {
                    $model->description = 'Запрос от пользователя';
                }

                $model->created_at = time();
				$model->updated_at = time();
				$model->status = 0;
			
			if($model->save()) {
				Yii::$app->session->setFlash('success', 'Ваш запрос принят. Он на рассмотрении.');
		   		
                return $this->redirect(['user/index']);
			}
		}

		//kbb 04.02.22 3:13
		Yii::$app->session->setFlash('error', 'Ошибка! Сумма вывода не может быть меньше 50');
//		Yii::$app->session->setFlash('error', 'Что-то не так');
		return $this->redirect(['user/index']);
        
    }



    /**
     * Finds the Surveys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Surveys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Surveys::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
