<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "withdrawals".
 *
 * @property int $id
 * @property int $user_id
 * @property decimal $amount
 * @property int $type
 
 * @property string $description

 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Withdrawals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdrawals';
    }

    // types:
    // 1 - обычный вывод средств
    // 2 - Вывод второй суммы $50 при достижении первых $500
    // 3 - smartphone
    // 4 - tour
    // 5 - auto
    // 6 - kv
    // 10 - Накопительный Фонд компании (Интеллектуальный кейс)
    // 20 - Комиссия компании


    // status
    // 0 - На рассмотрении
    // 1 - Выплачено
    // 10 - отмена


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'type'], 'required'],
            [['user_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
//kbb 04.02.22 2:55
//			[['amount'], 'number'],
//			[['amount'], 'number', 'min' => 50],
            //kbb 02.03.22 2:22
			[['amount'], 'number', 'min' => 50, 'when' => function($model) { return $model->type == 1; }],
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
            //kbb 04.02.22 3:26
			'user_id' =>  'АН',
            'fullname' => 'ФИО',
            //--
            'amount' =>  'Сумма',
            'type' =>  'Тип',
            'description' =>  'Описание',
            'created_at' =>  'Дата',
            'updated_at' =>  'Обновлено',
            'status' =>  'Статус',
        ];
    }

    public static function companyfundfill($user_id, $amount)
    {
        $user = User::findOne($user_id);

        // Гранты
        // kbb 18.02.22 00:02
        // company_margin - уже не участвует в формуле, в БД должна быть равна 1
        $new_withdrawal = new Withdrawals();
            $new_withdrawal->user_id = $user_id; 
            $new_withdrawal->type = 20;
//            $new_withdrawal->amount = $user->company_margin / 100 * $amount; // 1-10%
            $new_withdrawal->amount = 1 / 100 * $amount; // 1%
            $new_withdrawal->description = 'Стимулирующая комиссия';
            $new_withdrawal->created_at = time();
            $new_withdrawal->status = 1;
        $new_withdrawal->save();

        // iBank
        $new_withdrawal = new Withdrawals();
            $new_withdrawal->user_id = $user_id; 
            $new_withdrawal->type = 10;
            $new_withdrawal->amount = 5 / 100 * $amount;   // 5%
            $new_withdrawal->description = 'Комиссия компании';
            $new_withdrawal->created_at = time();
            $new_withdrawal->status = 1;
        $new_withdrawal->save();
        
    }
    
    public static function fond_all_second_payments()
    {
        $withdrawals_sum = Withdrawals::find()->where(['type' => 2])->sum('amount');
        
        return $withdrawals_sum;
    }

    public static function intellect_fond() // Накопительный Фонд
    {
        $withdrawals_sum = Withdrawals::find()->where(['type' => 10])->sum('amount'); 
        
        return $withdrawals_sum;
    }

    public static function company_fond() // Фонд компании
    {
        $withdrawals_sum = Withdrawals::find()->where(['type' => 20])->sum('amount');
        
        return $withdrawals_sum;
    }


    public static function check_big_bonus($user_id, $users_payments_in_branch)
    {
                        $withdrawal = Withdrawals::find()->where(['user_id' => $user_id, 'type' => 3])->one();
                        if ( (!$withdrawal) && ($users_payments_in_branch >= 25000) ) {
                            $new_withdrawal = new Withdrawals();
                                $new_withdrawal->user_id = $user_id; 
                                $new_withdrawal->type = 3;
                                $new_withdrawal->amount = 1000;
                                $new_withdrawal->description = 'Премиальный бонус: достижение выплат в малой ветке 25 000 долларов - смартфон';
                                $new_withdrawal->created_at = time();
                                $new_withdrawal->status = 1;
                            $new_withdrawal->save();

                            $messageLog = [
                                'status' => 'Премиальный бонус: достижение выплат в малой ветке 25 000 долларов - смартфон',
                                'new_withdrawal' => $new_withdrawal
                            ];
                            Yii::info($messageLog, 'process');
                        }

                        $withdrawal = Withdrawals::find()->where(['user_id' => $user_id, 'type' => 4])->one();
                        if ( (!$withdrawal) && ($users_payments_in_branch >= 100000) ) {
                            $new_withdrawal = new Withdrawals();
                                $new_withdrawal->user_id = $user_id; 
                                $new_withdrawal->type = 4;
                                $new_withdrawal->amount = 1500;
                                $new_withdrawal->description = 'Премиальный бонус: достижение выплат в малой ветке 100 000 долларов - групповая поездка за рубеж';
                                $new_withdrawal->created_at = time();
                                $new_withdrawal->status = 1;
                            $new_withdrawal->save();

                            $messageLog = [
                                'status' => 'Премиальный бонус: достижение выплат в малой ветке 100 000 долларов - групповая поездка за рубеж',
                                'new_withdrawal' => $new_withdrawal
                            ];
                            Yii::info($messageLog, 'process');
                        }

                        $withdrawal = Withdrawals::find()->where(['user_id' => $user_id, 'type' => 5])->one();
                        if ( (!$withdrawal) && ($users_payments_in_branch >= 500000) ) {
                            $new_withdrawal = new Withdrawals();
                                $new_withdrawal->user_id = $user_id; 
                                $new_withdrawal->type = 5;
                                $new_withdrawal->amount = 25000;
                                $new_withdrawal->description = 'Премиальный бонус: достижение выплат в малой ветке 500 000 долларов - автомобиль';
                                $new_withdrawal->created_at = time();
                                $new_withdrawal->status = 1;
                            $new_withdrawal->save();

                            $messageLog = [
                                'status' => 'Премиальный бонус: достижение выплат в малой ветке 500 000 долларов - автомобиль',
                                'new_withdrawal' => $new_withdrawal
                            ];
                            Yii::info($messageLog, 'process');
                        }

                        $withdrawal = Withdrawals::find()->where(['user_id' => $user_id, 'type' => 6])->one();
                        if ( (!$withdrawal) && ($users_payments_in_branch >= 6000000) ) {
                            $new_withdrawal = new Withdrawals();
                                $new_withdrawal->user_id = $user_id; 
                                $new_withdrawal->type = 6;
                                $new_withdrawal->amount = 45000;
                                $new_withdrawal->description = 'Премиальный бонус: достижение выплат в малой ветке 6 000 000 долларов - квартира';
                                $new_withdrawal->created_at = time();
                                $new_withdrawal->status = 1;
                            $new_withdrawal->save();

                            $messageLog = [
                                'status' => 'Премиальный бонус: достижение выплат в малой ветке 6 000 000 долларов - квартира',
                                'new_withdrawal' => $new_withdrawal
                            ];
                            Yii::info($messageLog, 'process');
                        }
    }


    //kbb 08.05.22 0:33
    public static function get_user_big_bonus($user_id)
    {
		$withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->andWhere(['IN','type', array(3,4,5,6)])->sum('amount');

		return $withdrawals_sum;
    }

    //kbb 04.02.22 2:39
    public static function get_user_withdrawals($user_id)
    {
		// all withdrawals SUM
		$withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->andWhere(['type'=>1])->sum('amount');

		return $withdrawals_sum;
    }

    //kbb 02.03.22 3:32
    public static function get_pending_user_withdrawals($user_id)
    {
		// all withdrawals SUM
		$withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>0])->andWhere(['type'=>1])->sum('amount');

		return $withdrawals_sum;
    }

    //ar 23,08,2022 12:06
    public static function get_second_payments($user_id){
        $payments = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['type'=>2])->count();

        return $payments;
    }


    //kbb 02.03.22 1:23
    public static function get_agent_commissions($user_id)
    {
        $withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->andWhere(['type'=>30])->sum('amount');

        return $withdrawals_sum;
    }

    public static function get_pending_agent_commissions($user_id)
    {
        $withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>0])->andWhere(['type'=>30])->sum('amount');

        return $withdrawals_sum;
    }




//    public static function get_user_withdrawals($user_id)
//    {
//        // all withdrawals SUM
//        $withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->sum('amount');
//
//        return $withdrawals_sum;
//    }

}
