<?php

namespace frontend\controllers;

use Yii;
use common\models\Earnings;
use common\models\EarningsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * SurveysitemsController implements the CRUD actions for Surveysitems model.
 */
class EarningsController extends Controller
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
                    'delete' => ['POST'],
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
     * Lists all Earnings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EarningsSearch();
		
		$searchModel->user_id =  Yii::$app->user->identity->id; // zyx
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



	
	
	
    /**
     * Finds the Surveysitems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Surveysitems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Surveysitems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.');
    }
}
