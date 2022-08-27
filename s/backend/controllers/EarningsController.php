<?php

namespace backend\controllers;

use Yii;
use common\models\Earnings;
use common\models\Payments;
use common\models\EarningsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EarningsController implements the CRUD actions for Surveys model.
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
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
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
		
		//$searchModel->payment_id = Yii::$app->request->get('payment_id'); // zyx
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Earnings model.
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
     * Creates a new Earnings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Earnings();
		$model->created_at = time();
     	$model->updated_at = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Earnings model.
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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Earnings model.
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
     * Finds the Earnings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Surveys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Earnings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionCreatedailyearningsplan1()
    {
		$yesterday = strtotime('-1 day', time()); 
		$payments = Payments::find()->where(['status'=> 1,  'description'=> 'Plan 1'])->andWhere(['<=', 'created_at', $yesterday])->all();
		
		foreach($payments as $payment) {
				
			echo '<br><br>Payment ID: '.$payment->id.'<br>';

			$earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->count();
			echo 'Found: '.$earnings_count.' earnings<br>';
			
			$today_earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->andWhere(['>=', 'created_at', $yesterday])->count();
			echo 'Found: '.$today_earnings_count.' today earnings<br>';
			
			if($earnings_count == 20) {
				echo 'Found '.$earnings_count.' earnings for payment ('.$payment->id.'). Payment is finished <br>';
				
				$payment->status = 2;
				$payment->updated_at = time();
				$payment->save();
				continue;
			}
			
			if( ($earnings_count < 20) && ($today_earnings_count == 0) ) {
				
				$earning_amount = $payment->amount * 1.24 / 20;
				echo 'Creating new Earning<br>';
				
				$earning = new Earnings;
					
					$earning->user_id = $payment->user_id;
					$earning->type = 1;
					
					$earning->amount = floor($earning_amount * 100) / 100; ;
					$earning->description = 'Daily Plan1 earning for Payment ('.$payment->id.')';
					$earning->payment_id = $payment->id;
					$earning->created_at = time();
					$earning->updated_at = time();
					$earning->status = 1;
					
				if($earning->save())
					echo 'Created Earning ('.$earning->id.') - '.$earning->amount.' USD for Payment ('.$payment->id.')<br>';
			}
			
		}
    }
	
	public function actionCreatedailyearningsplan2()
    {
		$yesterday = strtotime('-1 day', time()); 
		$payments = Payments::find()->where(['status'=> 1,  'description'=> 'Plan 2'])->andWhere(['<=', 'created_at', $yesterday])->all();
		
		foreach($payments as $payment) {
				
			echo '<br><br>Payment ID: '.$payment->id.'<br>';

			$earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->count();
			echo 'Found: '.$earnings_count.' earnings<br>';
			
			$today_earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->andWhere(['>=', 'created_at', $yesterday])->count();
			echo 'Found: '.$today_earnings_count.' today earnings<br>';
			
			if($earnings_count == 35) {
				echo 'Found '.$earnings_count.' earnings for payment ('.$payment->id.'). Payment is finished <br>';
				
				$payment->status = 2;
				$payment->updated_at = time();
				$payment->save();
				continue;
			}
			
			if( ($earnings_count < 35) && ($today_earnings_count == 0) ) {
				
				$earning_amount = $payment->amount * 1.68 / 35;
				echo 'Creating new Earning<br>';
				
				$earning = new Earnings;
					
					$earning->user_id = $payment->user_id;
					$earning->type = 1;
					
					$earning->amount = floor($earning_amount * 100) / 100; ;
					$earning->description = 'Daily Plan2 earning for Payment ('.$payment->id.')';
					$earning->payment_id = $payment->id;
					$earning->created_at = time();
					$earning->updated_at = time();
					$earning->status = 1;
					
				if($earning->save())
					echo 'Created Earning ('.$earning->id.') - '.$earning->amount.' USD for Payment ('.$payment->id.')<br>';
			}
			
		}
    }
	
	
	public function actionCreatedailyearningsplan3()
    {
		$yesterday = strtotime('-1 day', time()); 
		$payments = Payments::find()->where(['status'=> 1,  'description'=> 'Plan 3'])->andWhere(['<=', 'created_at', $yesterday])->all();
		
		foreach($payments as $payment) {
				
			echo '<br><br>Payment ID: '.$payment->id.'<br>';

			$earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->count();
			echo 'Found: '.$earnings_count.' earnings<br>';
			
			$today_earnings_count = Earnings::find()->where(['payment_id'=> $payment->id, ])->andWhere(['>=', 'created_at', $yesterday])->count();
			echo 'Found: '.$today_earnings_count.' today earnings<br>';
			
			if($earnings_count == 50) {
				echo 'Found '.$earnings_count.' earnings for payment ('.$payment->id.'). Payment is finished <br>';
				
				$payment->status = 2;
				$payment->updated_at = time();
				$payment->save();
				continue;
			}
			
			if( ($earnings_count < 50) && ($today_earnings_count == 0) ) {
				
				$earning_amount = $payment->amount * 1.90 / 50;
				echo 'Creating new Earning<br>';
				
				$earning = new Earnings;
					
					$earning->user_id = $payment->user_id;
					$earning->type = 1;
					
					$earning->amount = floor($earning_amount * 100) / 100; ;
					$earning->description = 'Daily Plan3 earning for Payment ('.$payment->id.')';
					$earning->payment_id = $payment->id;
					$earning->created_at = time();
					$earning->updated_at = time();
					$earning->status = 1;
					
				if($earning->save())
					echo 'Created Earning ('.$earning->id.') - '.$earning->amount.' USD for Payment ('.$payment->id.')<br>';
			}
			
		}
    }
	
}
