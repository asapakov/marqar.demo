<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;

/**
 * This is the model class for table "Payments".
 *
 * @property int $id
 * @property int $type   
 * @property string $description
 * @property decimal $amount
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Payments extends \yii\db\ActiveRecord
{
    const
        TYPE_START = 1,
        TYPE_SECOND = 2,
        STATUS_WAITING = 0,
        STATUS_PAID = 1;

    protected $_types = [
        self::TYPE_START => 'Оплата при регистрации',
        self::TYPE_SECOND => 'Второй платеж',
    ];

    protected $_statuses = [
        self::STATUS_WAITING => 'Ожидает оплаты',
        self::STATUS_PAID => 'Оплачено',
    ];
    
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'amount'], 'required'],
            [['type',  'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'category_id' =>  'Тип',
            'description' =>  'Описание',
            'amount' =>  'Сумма',
            'user_id' => 'АН',
            //kbb 11.02.22 1:22
            'fullName' => 'ФИО',
            'created_at' =>  'Дата',
            'updated_at' =>  'Обновлено',
            'status' =>  'Статус',
            'type' =>  'Тип',
        ];
    }
	
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

    //kbb 11.02.22 1:23
    public function getFullName()
    {
        $user = User::findOne($this->user_id);

        $messageLog = [
            'status' => 'Выбор пользователя',
            'user' => $user
        ];
        Yii::info($messageLog, 'process');


        return $user->last_name.' '.$user->first_name.' '.$user->patr_name;
    }

    public static function getKztusdrate()
	{
        $xml = simplexml_load_file('https://www.nationalbank.kz/rss/rates_all.xml');

        foreach($xml->channel->item as $cur) {
            if($cur->title == 'USD')
                return floatval($cur->description);
        }

        // try {
    	// 	$xml = simplexml_load_file('https://www.nationalbank.kz/rss/rates_all.xml');

        //     foreach($xml->channel->item as $cur) {
        //         if($cur->title == 'USD')
        //             return floatval($cur->description);
        //     }
        // } catch (ErrorException $e) {
        //     return 438.04;
        // }

//        return "local dev";
	}

    public function createstartpayment($user_id)
	{
		$start_payment = new Payments();
            $start_payment->user_id = $user_id;
            $start_payment->type = 1;
            // $start_payment->amount = 60; //60 * ceil($start_payment->getKztusdrate());
            $start_payment->amount = 68; //kbb 04.05.22
            $start_payment->description = 'Оплата при регистрации';
            $start_payment->status = 0;
            $start_payment->created_at = time();
        $start_payment->save();

        if($start_payment->errors) {
            //kbb 06.02.22 6:07
            $messageLog = [
                'status' => 'Ошибка при создании стартового платежа',
                'error' => $start_payment->errors
            ];
            Yii::info($messageLog, 'process');

            echo '<pre>';
            var_dump($start_payment->errors);
            exit;
        }

        //kbb 06.02.22 6:07
        $messageLog = [
            'status' => 'Создание стартового платежа',
            'start_payment' => $start_payment
        ];
        Yii::info($messageLog, 'process');
	}

    public function getPaymenttype()
	{
		
	}

    public function getTypes()
    {
        return $this->_types;
    }

    public function getType($type)
    {
        return $this->_types[$type];
    }

    public function getStatuses()
    {
        return $this->_statuses;
    }

    public function getStatus($status)
    {
        return $this->_statuses[$status];
    }



    public function create_robokassa_link($payment_id)
    {
        $payment = Payments::findOne([
			'id' => $payment_id,
			'user_id' => Yii::$app->user->identity->id,
		]);	
        
        
        $mrh_login = "markharllp";      // your login here
        $mrh_pass1 = "bbEIx3wO7pLAr7b24KjU";   // merchant pass1 here

        // order properties
        $inv_id    = $payment->id;        // shop's invoice number 
                                            // (unique for shop's lifetime)
        $inv_desc  = $payment->description.' от '.$payment->user->last_name.' '.$payment->user->first_name.' ('.$payment->user->id.')';                // invoice desc
        $out_summ  = $payment->amount;   // invoice summ

        // build CRC value
        $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

        // build URL
        $url = "https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=$mrh_login&".
            "OutSum=$out_summ&InvId=$inv_id&Description=$inv_desc&SignatureValue=$crc";

        return $url;
    }

    public function create_bcc_link($payment_id)
    {
        $payment = Payments::findOne([
			'id' => $payment_id,
			'user_id' => Yii::$app->user->identity->id,
		]);	
        
        $start_url = 'https://test3ds.bcc.kz:5445/cgi-bin/cgi_link';
        $currency = 398;  // tenge
        $timestamp = gmdate("YmdHis");

        $amount = ceil( $payment->amount * Payments::getKztusdrate() );

        $merchant = 'merchantname';
        $terminal = '88888881';
        $merch_gmt = '6';
        $trtype = '1';
        $nonce = '999'.$payment->id.$currency.$amount.$timestamp;
        
        $key = "6BB0AC02E47BDF73D98FEB777F3B5294";
        $data = '';
        $data = strlen($amount).$amount.
                strlen($currency).$currency.
                strlen('999'.$payment->id).'999'.$payment->id.
                strlen($merchant).$merchant.
                strlen($terminal).$terminal.
                strlen($merch_gmt).$merch_gmt.
                strlen($timestamp).$timestamp.
                strlen($trtype).$trtype.
                strlen($nonce).$nonce;
       // $data = "5 25761 3 398 6 999199 16 MERCHANTMERCHANT 8 88888881 1 6 14 2021-07-12 12-44-07 1 1 14 999199 398 25761";
        $decodedKey = pack("H*", $key);
        $sign = hash_hmac("sha1", $data, $decodedKey);
// echo '<br>';
// echo $data;
// echo '<br>';
// echo $sign;
// echo '<br>';

        $url = $start_url.
                '?AMOUNT='.$amount.
                '&CURRENCY='.$currency.
                '&ORDER=999'.$payment->id.
                '&DESC='.'Payment('.$payment->user->id.')'.
                '&MERCHANT='.$merchant.
                '&TERMINAL='.$terminal.
                '&MERCH_GMT='.$merch_gmt.
                '&TIMESTAMP='.$timestamp.
                '&TRTYPE='.$trtype.
                '&NONCE='.$nonce.
                '&BACKREF='.'https://www.marqar.kz'.
                '&P_SIGN='.$sign.
                '&LANG='.'ru';
// echo $url;
// echo '<br>';               

        return $url;
    }


    



    public static function get_user_payments($user_id)
    {
		// all withdrawals SUM
		$payments_sum = Payments::find()->where(['user_id'=>$user_id])->andWhere(['status'=>1])->sum('amount');

		return $payments_sum;
    }

}
