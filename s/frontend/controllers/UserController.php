<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use common\models\Payments;
use common\models\PaymentsSearch;
use common\models\Earnings;
use common\models\EarningsSearch;
use common\models\Withdrawals;
use common\models\WithdrawalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                       'allow' => true,
                       'roles' => ['@'],
                   ],
               ],
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
     * Lists all statsfor user.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
		$searchModel->user_id =  Yii::$app->user->identity->id; 
        $paymentsProvider = $searchModel->searchlast3(Yii::$app->request->queryParams);
		
		 $searchModel = new EarningsSearch();
		 $searchModel->user_id =  Yii::$app->user->identity->id; 
         $earningsProvider = $searchModel->searchlast3(Yii::$app->request->queryParams);
		
		$searchModel = new WithdrawalsSearch();
		$searchModel->user_id =  Yii::$app->user->identity->id; 
        $withdrawalsProvider = $searchModel->searchlast3(Yii::$app->request->queryParams);

        return $this->render('index', [
           // 'searchModel' => $searchModel,
			'paymentsProvider' => $paymentsProvider,
            'earningsProvider' => $earningsProvider,
			'withdrawalsProvider' => $withdrawalsProvider,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
		$id =  Yii::$app->user->identity->id; // zyx
        $model = $this->findModel($id);
		$model->updated_at = time();

        if ($model->load(Yii::$app->request->post())) {
			//$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			 if ( $model->save() )
            	return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionInvited()
    {
        $searchModel = new UserSearch();
        $searchModel->ref_id = Yii::$app->user->identity->id;

        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['ref_id' => Yii::$app->user->identity->id/*, 'can_left' => 1*/]); 


        return $this->render('invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPresented()
    {
        $searchModel = new UserSearch();
        $searchModel->ref_id = Yii::$app->user->identity->id;

        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['etalon_id' => Yii::$app->user->identity->id/*, 'can_left' => 1*/]); 


        return $this->render('presented', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
