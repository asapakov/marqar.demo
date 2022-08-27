<?php

namespace frontend\controllers;

use Yii;
use common\models\Payments;
use common\models\User;

use common\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\auth\HttpBasicAuth;

/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class BccController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $user = User::find()->where(['username' => $username])->one();
                if($user) {
                    if (Yii::$app->getSecurity()->validatePassword($password, $user->password_hash)) {
                        return $user;
                    }
                }
                
                return null;
            },
        ];

        return $behaviors;
    }



    public function actionResult()
    {
        $function = Yii::$app->request->post()['Function'];
        $result = Yii::$app->request->post()['Result'];
        $result_code = Yii::$app->request->post()['RC'];
        $amount = Yii::$app->request->post()['Amount'];
        $currency = Yii::$app->request->post()['Currency'];
        $order_num = substr(Yii::$app->request->post()['Order'], 3);
        $rrn = Yii::$app->request->post()['RRN'];
        $int_ref = Yii::$app->request->post()['IntRef'];
        $auth_code = Yii::$app->request->post()['AuthCode'];

        $payment = Payments::findOne($order_num);
        if ($payment) {
            $payment->status = 1;
            $payment->updated_at = time();
            $payment->save();
        }
    }
}
