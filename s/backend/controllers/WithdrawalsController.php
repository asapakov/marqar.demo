<?php

namespace backend\controllers;

use Yii;
use common\models\Withdrawals;
use common\models\WithdrawalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WithdrawalsController implements the CRUD actions for Variants model.
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'confirm', 'decline'],
                        'allow' => true,
                        'roles' => ['admin'],
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
     * Lists all Withdrawals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WithdrawalsSearch();
		
		$searchModel->status =  Yii::$app->request->get('status'); // zyx
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
           'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Withdrawals model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    /**
     * Creates a new Withdrawals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Withdrawals();
		
		$model->created_at = time();
     	$model->updated_at = time();
		//$model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Withdrawals model.
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
            return $this->redirect(['withdrawals/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Withdrawals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$this->findModel($id)->delete();

        return $this->redirect(['withdrawals/index']);
    }


    /**
     * Finds the Withdrawals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Variants the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Withdrawals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	

	public function actionConfirm($withdrawal)
    {
		$model = $this->findModel($withdrawal);
		
			$model->status = 1;
		
		$model->save();

        return $this->redirect(['withdrawals/index', 'status' => 0]);
    }


    public function actionDecline($withdrawal)
    {
		$model = $this->findModel($withdrawal);
		
			$model->status = 10;
		
		$model->save();

        return $this->redirect(['withdrawals/index', 'status' => 0]);
    }

}
