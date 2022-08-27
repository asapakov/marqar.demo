<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Contacts;
use common\models\ContactsSearch;

use common\models\User;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        $searchModel->user_id = Yii::$app->user->identity->id;
        $searchModel->type = Yii::$app->request->get('type');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex_add()
    {
        $searchModel = new ContactsSearch();
        $searchModel->user_id = Yii::$app->user->identity->id;
        $searchModel->type = Yii::$app->request->get('type');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $type = Yii::$app->request->get('type');

        if($type == 1) {
            $contacts_num = Contacts::find()->where(['user_id' => Yii::$app->user->identity->id, 'type' => 1])->count();
            if($contacts_num >= 20) {
                Yii::$app->session->setFlash('error', 'Вы уже заполнили все контакты знакомых и друзей.');
                return $this->redirect(['index', 'type' => $type]);
            } 

        }

        if ( $model->load(Yii::$app->request->post() ) && $type) {

            $model->created_at = time();
            $model->type = $type;
            $model->user_id = Yii::$app->user->identity->id;

            if($model->save()) {

                $contacts_num = Contacts::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
                if($contacts_num == 20) {
                    Yii::$app->session->setFlash('success', 'Поздравляем. Вы добавили 20 знакомых.');
                    //User::allcoditions(Yii::$app->user->identity->id);
                    
                } 

                if($type >= 2)
                    return $this->redirect(['index_add', 'type' => $type]);
                else
                    return $this->redirect(['index', 'type' => $type]);
            }

        }

        return $this->render('create', [
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
}
