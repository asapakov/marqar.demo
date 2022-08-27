<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\CsvForm;
use yii\web\UploadedFile;
use mPDF;


/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['signup','upload','uploadsurveydata'],
                        'allow' => true,
                        'roles' => ['admin'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
		if (Yii::$app->request->post())											//zyx
		if (Yii::$app->request->post()["LoginForm"]["username"] != 'admin')
				return $this->goHome();
				
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	
	    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
	
	public function actionUpload()
	{
		ini_set('max_execution_time', 900); //300 seconds = 5 minutes
		require_once '../../vendor/mpdf/mpdf/mpdf.php';
		
		$model = new CsvForm;
		
		$surveys_html = '';
		
		if($model->load( Yii::$app->request->post() )) {
			$file = UploadedFile::getInstance($model,'file');
			$filename = 'Data.'.$file->extension;
			$upload = $file->saveAs('data/'.$filename);
			if($upload) {
				define('CSV_PATH','data/');
				$csv_file = CSV_PATH . $filename;
				$filecsv = file($csv_file);
				//print_r($filecsv);
				
				
				//начинаем перебор по строкам файла
				foreach($filecsv as $data){
					//$data = mb_convert_encoding($data, "UTF-8");
					// строку в массив
					$row_data = explode(";",$data);
				
					// удалить BOM из первого элемента
					if(substr($row_data[0], 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) 
						$row_data[0]= substr($row_data[0], 3);

					// если строка начинается с 'номер'
					if ($row_data[0] == 'nomer_ankety') {
						$first_row = array();
						$etalon = 0;
						//начинаем перебор ячеек в строке
						foreach($row_data as $cell ) {
							
							$cell_data = explode('.', $cell);

								if ($cell_data[0] != $etalon)	{
									$first_row[] = $cell_data[0];
									//echo  '<br>'.$cell_data[0];
								} else {
									$first_row[] = 0;
									//echo 0;
								}
						
							$etalon = $cell_data[0];					  
						}
						
						//удаляем ячейки, которые не содержут варианты ответов
						//array_splice($first_row, 0, 6);
						//var_dump($first_row);
					}
					
					// если уже не первая строчка
					else	{

						$surveys_html .=  '<h3 style="text-align:center">Анкета №'.$row_data[0].'</h3>';
						$surveys_html .=  '<table width="100%" border="1" cellspacing="0" cellpadding="3"><tr>';
						
						$i = 0;
						
						foreach($row_data as $cell) {
							
							if ($i < 10)	{
								$i++;
								continue;
							}
							
						/*	if ($cell == ' ')	{
								$i++;
								continue;
							}*/
							
							
							///////////////// собираем данные ответов
							if ($first_row[$i] !== 0) {
								$surveys_html .=  '</tr><tr><th style="font-size: 9pt;" width="50">'.$first_row[$i].'</th><td style="font-size: 9pt;">'.$cell.'</td>';
								
							}	else	{
								$surveys_html .=  '<td style="font-size: 9pt;">'.$cell.'</td>';
							}
							
							$i++;
						}
						$surveys_html .=  '</tr></table>';
					}

				}
				
				unlink('data/'.$filename);
				//return $this->redirect(['site/index']);
				echo $surveys_html;
				
				//$mpdf = new mPDF();
				//$mpdf->WriteHTML($surveys_html);
        		//$mpdf->Output('surveys_html.pdf', 'D');

        }
		}else{
			return $this->render('upload',['model'=>$model]);
		}
	}
	
	
	
	
	public function actionUploadsurveydata()
	{
		ini_set('max_execution_time', 900); //300 seconds = 5 minutes
		require_once '../../vendor/mpdf/mpdf/mpdf.php';
		
		$model = new CsvForm;
		
		$data_html = '';
		
		if($model->load( Yii::$app->request->post() )) {
			$file = UploadedFile::getInstance($model,'file');
			$filename = 'Data.'.$file->extension;
			$upload = $file->saveAs('data/'.$filename);
			if($upload) {
				define('CSV_PATH','data/');
				$csv_file = CSV_PATH . $filename;
				$filecsv = file($csv_file);
				//print_r($filecsv);
				
				
				//начинаем перебор по строкам файла
				foreach($filecsv as $data){
					//$data = mb_convert_encoding($data, "UTF-8");
					// строку в массив
					$row_data = explode(";",$data);
				
					// удалить BOM из первого элемента
					if(substr($row_data[0], 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) 
						$row_data[0]= substr($row_data[0], 3);

					// если строка начинается с 'номер'
					if ($row_data[0] == 'nomer_ankety') {
						$first_row = array();
						$etalon = 0;
						//начинаем перебор ячеек в строке
						foreach($row_data as $cell ) {
							
							$cell_data = explode('.', $cell);

								if ($cell_data[0] != $etalon)	{
									$first_row[] = $cell_data[0];
									//echo  '<br>'.$cell_data[0];
								} else {
									$first_row[] = 0;
									//echo 0;
								}
						
							$etalon = $cell_data[0];					  
						}
						
						//удаляем ячейки, которые не содержут варианты ответов
						//array_splice($first_row, 0, 10);
						//var_dump($first_row);
					}
					
					// если уже не первая строчка
					else	{
						if ($model->output_title == 1)
							$data_html .=  '<h3 style="text-align:center">Анкета №'.$row_data[0].'</h3>';
							
						$data_html .=  '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
						
						$i = 0;
						
						foreach($row_data as $cell) {
							
							if ($i > 7)	{
								$i++;
								continue;
							}
							
							if ($cell == ' ')	{
								$i++;
								continue;
							}
							
							///////////////// собираем данные для маршрутного листа
							if ($cell == $row_data[2])	{
								$data_html .=  '<tr><td colspan="2">ФИО: '.$cell.'</td>';
								$i++;
								continue;  // пропускаем 
							}
							
							if ($cell == $row_data[3])	{
								$data_html .=  '<td colspan="2">Номер телефона: '.$cell.'</td></tr>';
								$i++;
								continue;  // пропускаем 
							}
							
							if ($cell == $row_data[4])	{
								$data_html .=  '<tr><td>Улица: '.$cell.'</td>';
								$i++;
								continue;  // пропускаем 
							}
							
							if ($cell == $row_data[5])	{
								$data_html .=  '<td>Дом: '.$cell.'</td>';
								$i++;
								continue;  // пропускаем 
							}
							
							if ($cell == $row_data[6])	{
								$data_html .=  '<td>Кв: '.$cell.'</td>';
								$i++;
								continue;  // пропускаем 
							}
							
							if ($cell == $row_data[7])	{
								$data_html .=  '<td>Гео. локация: '.$cell.'</td></tr>';
								$i++;
								continue;  // пропускаем 
							}
							
							$i++;
						}
						$data_html .=  '</table><br>';
					}

				}
				
				unlink('data/'.$filename);
				//return $this->redirect(['site/index']);
				echo $data_html;
				
				
				
				
				//$mpdf = new mPDF();
				//$mpdf->WriteHTML($data_html);
        		//$mpdf->Output('data_html.pdf', 'D');
        }
		}else{
			return $this->render('upload',['model'=>$model]);
		}
	}
	
}
