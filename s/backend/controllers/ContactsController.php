<?php

namespace backend\controllers;

use Yii;
use common\models\Contacts;
use common\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\services\Sms;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacts model.
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
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSendinvitemessage()
    {
        $contacts = Contacts::find()->where(['sent' => 0])->all();

        foreach($contacts as $contact){

            $phone_num = str_replace(' ', '', $contact->phone);
            $phone_num = str_replace('+', '', $phone_num);
            $mess_text = 'Здравствуйте! Вас приветствует '.$contact->user->first_name.' '.$contact->user->last_name.'от имени международной компании Markhar LLP. На сайте компании, в папке «ВАЖНО», содержится информация лично для Вас!
            Ознакомиться с содержанием папки можно, пройдя по ссылке: https://marqar.kz/s/ref/?rid='.$contact->user->id;
            echo '<pre>';
            echo $phone_num;
            echo ':';
            echo $mess_text;
            echo '<br>';
            
            Sms::getInstance()->send($phone_num, $mess_text);
            $contact->sent = 1;
            $contact->sent_time = time();
            $contact->save(false);

            //   try {
                 
            //   } catch (SmsException $e) {
            //      // В лог уже записалась ошибка. Поэтому просто глушим
            //      $contact->sent = 0;
            //      $contact->save();
            //   }

        }
          
    }
    
}
