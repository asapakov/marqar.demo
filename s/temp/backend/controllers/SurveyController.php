<?php

namespace backend\controllers;

use Yii;
use backend\models\Survey;
use backend\models\SurveySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use backend\models\Surveys;
use backend\models\Questions;
use backend\models\Variants;
use backend\models\Surveysitems;

/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class SurveyController extends Controller
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
        ];
    }

    /**
     * Lists all Survey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Survey model.
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
     * Creates a new Survey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Survey();
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
     * Updates an existing Survey model.
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
     * Deletes an existing Survey model.
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
     * Finds the Survey model based on its primary key value.
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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	
	/**

     */
    public function actionDownload()
    {
        		
		// ищем все вопросы для данного анкетирования
		$questions = Questions::find()->where(['survey_id'=>Yii::$app->request->get('survey_id')])->all(); 
		$question_quantity = Questions::find()->where(['survey_id'=>Yii::$app->request->get('survey_id')])->count();
		
		// header
		$file_content = "\xEF\xBB\xBF";
		$file_content .= "FILE HANDLE data /NAME='D:\SPSS\data.dat' .
DATA LIST FILE='data' FREE /";
		// surveyval )) info
		$file_content .= '
		nomer_ankety (A255)
		i1 (A255)
		i2 (A255)
		i3 (A255)
		i4 (A255)
		i5 (A255)
		i6 (A255)
		i7 (A255)';
		
		// questions info
		$i=0;
		while ($i++ < $question_quantity) {
			$file_content .= '
		q'.$i.' (A255)';
		}
		$file_content .= "
		.";
		
		// VARIABLE LABELS
		$file_content .= "
VARIABLE LABELS
		nomer_ankety 'Номер анкеты'
		i1 'Номер анкетирующего'
		i2 'Имя Респондента'
		i3 'Телефон'
		i4 'Улица'
		i5 'Дом'
		i6 'Квартира'
		i7 'Гео данные'";
		
		// questions info
		$i=0;
		while ($i++<$question_quantity) {
			$file_content .= "
		q".$i." 'q".$i."'";
		}
		$file_content .= "
		.";
		
		// VALUE LABELS
		$file_content .= "
VALUE LABELS";
		
		$i=1;
		foreach ($questions as $question) { 
			$variants = Variants::find()->where(['question_id'=>$question->id])->all(); 
			$file_content .= "
		q".$i;
			$j = 1;
				foreach ($variants as $variant) {
					
		$file_content .= "
		".$j." '".$variant->title."'";
						$j++;
				}
			$file_content .= "/";
			$i++;
		}
		
		$file_content .= ".
EXECUTE.";

		$file_content .= "
SAVE OUTFILE='D:\SPSS\data.sav' /COMPRESSED .";


		header('Content-Disposition: attachment; filename="data.sps"');
		header('Content-Type: application/octet-stream'); # Don't use application/force-download - it's not a real MIME type, and the Content-Disposition header is sufficient
		header('Content-Length: ' . strlen($file_content));
		header('Connection: close');
		
		
		echo $file_content;
		
		//return $this->render('index');
		
    }
	
	
	
	/**

     */
    public function actionDatdownload()
    {
       	// ищем все анкеты для данного анкетирования
		$surveys = Surveys::find()->where(['survey_id'=>Yii::$app->request->get('survey_id')])->all();
		
		// ищем все вопросы для данного анкетирования
		//$questions = Questions::find()->where(['survey_id'=>Yii::$app->request->get('survey_id')])->all(); 
		$question_quantity = Questions::find()->where(['survey_id'=>Yii::$app->request->get('survey_id')])->count();
		
		// header
		$file_content = "\xEF\xBB\xBF";
/*		$file_content .= 'nomer_ankety;i1;i2;i3;i4;i5;i6;';
		
		// questions info
		$i=0;
		while ($i++ < $question_quantity) {
			$file_content .= 'q'.$i.";";
		}
		$file_content .= PHP_EOL;*/
		
		
		foreach ($surveys as $one_survey) {
			//echo '<br><br>Anketa = '.$one_survey->id.'<br>';
			if($one_survey->id != '') $file_content .= "'".$one_survey->id."' ";
			else $file_content .= "'*' ";
			if($one_survey->surv_num != '') $file_content .= "'".$one_survey->surv_num."' ";
			else $file_content .= "'*' ";
			if($one_survey->resp_name != '') $file_content .= "'".$one_survey->resp_name."' ";
			else $file_content .= "'*' ";
			if($one_survey->tel != '') $file_content .= "'".$one_survey->tel."' ";
			else $file_content .= "'*' ";
			if($one_survey->geo_ul != '') $file_content .= "'".$one_survey->geo_ul."' ";
			else $file_content .= "'*' ";
			if($one_survey->geo_dom != '') $file_content .= "'".$one_survey->geo_dom."' ";
			else $file_content .= "'*' ";
			if($one_survey->geo_kv != '') $file_content .= "'".$one_survey->geo_kv."' ";
			else $file_content .= "'*' ";
			if($one_survey->geo_data != '') $file_content .= "'".$one_survey->geo_data."' ";
			else $file_content .= "'*' ";
			
			// ищем все вопросы из данного анкетирования
			//$question_quantity = Questions::find()->where(['survey_id'=>$one_survey->id])->count();
			
				
			for($i=1; $i<=$question_quantity; $i++)	{
				// ищем вопрос в анкете с указанной позицией
				$question = Questions::find()->where(['pos'=>$i, 'survey_id'=>Yii::$app->request->get('survey_id')])->one();
				
				
				
				if(isset($question->id))	{
					
				
					$surveysitem = Surveysitems::find()->where(['surveys_id'=>$one_survey->id, 'question_id'=>$question->id])->one(); 
					
					/*echo '<pre> ';
						echo 'id ankety ='.$one_survey->id.'<br>';
						echo 'Вопрос: '.$question->title.' ('.$question->id.')<br>';
					echo '</pre>';*/
					
					if(isset($surveysitem->variants)) {
						$file_content .= "'".$surveysitem->variants."' ";
						//echo 'Ответ: '.$surveysitem->variants.'<br>';
						
					} else {
						$file_content .= "'-' ";
						//echo 'Ответ: -<br>';
					}
				}
				else	{
					$file_content .= "'-' ";
/*					echo '<pre> ';
						echo 'id ankety ='.$one_survey->id.'<br>';
						echo 'Вопрос: -<br>';
					echo '</pre>';*/
				}
				
				
				// ищем ответы из всех анкет по данному анкетированию
				//$surveysitems = Surveysitems::find()->where(['surveys_id'=>$one_survey->id])->all(); 
				
				
					
				
				
						
					//foreach ($surveysitems as $surveysitem) {
					//	
					//	$file_content .= "'".$surveysitem->variants."' ";
					//}
			}

			$file_content .= PHP_EOL;
			
			
		}
		
		

		
		
//echo $file_content;


		header('Content-Disposition: attachment; filename="data.dat"');
		header('Content-Type: application/octet-stream'); # Don't use application/force-download - it's not a real MIME type, and the Content-Disposition header is sufficient
		header('Content-Length: ' . strlen($file_content));
		header('Connection: close');
		
		
		echo $file_content;
		
		//return $this->render('index');
		
    }
}
