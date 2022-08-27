<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "earnings".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property decimal $amount
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Earnings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'earnings';
    }

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'amount', 'created_at'], 'required'],
            [['user_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
			[['amount'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' =>  '№',
            'user_id' => 'Пользователь',
            'type' =>  'Тип',
			'amount' =>  'Сумма',
            'description' => 'Описание',
            'created_at' => 'Дата',
			'updated_at' => 'Обновлено',
			'status' =>  'Статус',
        ];
    }

    public function addbinarbonus($user_id, $starter_id)
    {
        $user = User::findOne($starter_id);
        $pamount = floor(50 * 0.06);

        $earning = new Earnings();
            $earning->user_id = $user_id; 
            $earning->type = 1;
            $earning->amount = $pamount;
            $earning->description = 'Бонус за участие - '.$user->last_name.' '.$user->first_name.' '.$user->patr_name.'('.$starter_id.')';
            $earning->created_at = time();
            $earning->status = 1;
        if($earning->save()) {
            $messageLog = [
                'status' => 'Новый заработок пользователя создан',
                'earning' => $earning
            ];
            Yii::info($messageLog, 'process');

            Withdrawals::companyfundfill($user_id, $pamount );
        } else {
            $messageLog = [
                'status' => 'Ошибка сохранения заработка пользователя',
                'error' => $earning->getErrors()
            ];
            Yii::info($messageLog, 'process');
        }
    }

    //kbb 02.03.22 0:52 Агентское вонаграждение
    public function add_agents_commission($user_id, $starter_id)
    {
        $user = User::findOne($starter_id);
        $pamount = 16;

        $earning = new Earnings();
            $earning->user_id = $user_id;
            $earning->type = 2;
            $earning->amount = $pamount;
            $earning->description = 'Агентское вознаграждение - '.$user->last_name.' '.$user->first_name.' '.$user->patr_name.'('.$starter_id.')';
            $earning->created_at = time();
            $earning->status = 1;
        if($earning->save()) {
            $messageLog = [
                'status' => 'Агентское вознаграждение начислено',
                'earning' => $earning
            ];
            Yii::info($messageLog, 'process');

            Withdrawals::companyfundfill($user_id, $pamount );
        } else {
            $messageLog = [
                'status' => 'Ошибка сохранения АВ пользователя',
                'error' => $earning->getErrors()
            ];
            Yii::info($messageLog, 'process');
        }
    }

    
    // public function checkfirst500($user_id)
    // {
    //     $earnings_sum = Earnings::find()->where(['user_id'=>$user_id])->sum('amount');
    //     if($earnings_sum > 500) {
    //         $withdrawal = new Withdrawals();
					
    //             $withdrawal->user_id = $user_id; 
    //             $withdrawal->type = 2;
    //             $withdrawal->amount = 50;
    //             $withdrawal->description = 'Достижение первых $500. Автоматическое снятие $50.';
    //             $withdrawal->created_at = time();
    //             $withdrawal->status = 1;
                    
    //         $withdrawal->save();

    //         $start_payment = new Payments();
    //             $start_payment->user_id = $user_id;
    //             $start_payment->type = 2;
    //             $start_payment->amount = 50; 
    //             $start_payment->description = 'Вторая оплата';
    //             $start_payment->status = 1;
    //             $start_payment->created_at = time();
    //         $start_payment->save();

    //     }
    // }

    // kbb 27.12.21 4:17 Исправление глюка с периодическим снятием
    public function checkfirst500($user_id)
    {
        $user = User::findOne($user_id);

        if($user->first_500 == 0) {
            $earnings_sum = Earnings::find()->where(['user_id'=>$user_id])->sum('amount');
            if($earnings_sum > 500) {
                $withdrawal = new Withdrawals();
                        
                    $withdrawal->user_id = $user_id; 
                    $withdrawal->type = 2;
                    $withdrawal->amount = 50;
                    $withdrawal->description = 'Достижение первых $500. Автоматическое снятие $50.';
                    $withdrawal->created_at = time();
                    $withdrawal->status = 1;
                        
                if($withdrawal->save()) {
                    $messageLog = [
                        'status' => 'Снятие у пользователя создано',
                        'withdrawal' => $withdrawal
                    ];
                    Yii::info($messageLog, 'process');

                    $user->first_500 = 1;
                    if ($user->save(false)) {
                        $messageLog = [
                            'status' => 'Обновление пользователя произведено успешно first_500 = 1',
                            'user' => $user
                        ];
                        Yii::info($messageLog, 'process');
                    } else {
                        $messageLog = [
                            'status' => 'Ошибка обновления пользователя first_500 = 1',
                            'error' => $user->getErrors()
                        ];
                        Yii::info($messageLog, 'process');
                    }
                } else {
                    $messageLog = [
                        'status' => 'Ошибка сохранения снятия',
                        'error' => $withdrawal->getErrors()
                    ];
                    Yii::info($messageLog, 'process');
                }
    
                $start_payment = new Payments();
                    $start_payment->user_id = $user_id;
                    $start_payment->type = 2;
                    // $start_payment->amount = 50; 
                    $start_payment->amount = 56; //kbb 05.05.22
                    $start_payment->description = 'Вторая оплата';
                    $start_payment->status = 1;
                    $start_payment->created_at = time();
                if ($start_payment->save()) {
                    $messageLog = [
                        'status' => 'Создание платежа. Вторая оплата',
                        'start_payment' => $start_payment
                    ];
                    Yii::info($messageLog, 'process');
                } else {
                    $messageLog = [
                        'status' => 'Ошибка создания платежа',
                        'error' => $start_payment->getErrors()
                    ];
                    Yii::info($messageLog, 'process');
                }
    
            }
        }
    }
    

    public static function get_user_earnings($user_id)
    {
		// all withdrawals SUM
//		$earnings_sum = Earnings::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->sum('amount');
        //kbb 02.03.22 1:23
        $earnings_sum = Earnings::find()->where(['user_id'=>$user_id])->andWhere(['type'=>1])->andWhere(['status'=>1])->sum('amount');

		return $earnings_sum;
    }

    //kbb 02.03.22 1:23
    public static function get_agent_commissions($user_id)
    {
        $earnings_sum = Earnings::find()->where(['user_id'=>$user_id])->andWhere(['type'=>2])->andWhere(['status'=>1])->sum('amount');

        return $earnings_sum;
    }

}
