<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Contacts;


use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
	public $last_name;
	public $patr_name;
	public $username;
    public $email;
	public $phone;
    public $password;
	public $password1;

	public $repeat_password;

	public $agreement;
	public $secret_question;
	public $secret_answer;
	public $rid;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email уже был указан кем-то другим.'],

			['phone', 'trim'],
            ['phone', 'required'],
			// ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот номер уже был указан кем-то другим.'],
			['phone', PhoneInputValidator::className()],


			['first_name', 'trim'],
			['first_name', 'required'],
            ['first_name', 'string', 'min' => 3, 'max' => 255],

			['last_name', 'trim'],
			['last_name', 'required'],
            ['last_name', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
			['password', 'string', 'min' => 6, 'max' => 50],

            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совподают'],

			['patr_name', 'trim'],
            ['patr_name', 'string', 'min' => 2, 'max' => 255],

			['agreement', 'required', 'requiredValue' => 1, 'message' => 'Необходимо согласиться с условиями'],
            //kbb 16.02.22 0:29
            ['rid', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['rid' => 'id']],
			[['rid'], 'integer'],
            //kbb 16.02.22 0:29
//			['rid', 'required', 'message' => 'Необходимо указать ID спонсора'],
			['rid', 'required', 'message' => 'Необходимо указать АН продавца'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
	{
		if ($this->validate()) {

			$user = new User();
			$user->first_name = $this->first_name;
			$user->last_name = $this->last_name;
			$user->patr_name = $this->patr_name;
			//$user->username = $this->username;
			$user->username = $this->email;
			$user->email = $this->email;
			$user->phone = $this->phone;
			$user->ref_id = $this->rid;


			$user->password = $this->password;

            $password = $this->password;

// kbb 31.01.22 01:25
//			$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
//			$max=10;
//			$size=StrLen($chars)-1;
//			$password=null;
//			while($max--)
//				$password.=$chars[rand(0,$size)];


			$contact = Contacts::find()->where(['phone' => $user->phone])->one();
			$user->company_margin = 1;

            // kbb 18.02.22 00:05 На данный момент этот параметр не нужен
//			if($contact) {
//				$diff = time() - $contact->created_at;
//
//				$seven_days = 86400 * 7;
//				$fourteen_days = 86400 * 14;
//				$thirty_days = 86400 * 30;
//
//				if($diff < $seven_days) // 7 days
//					$user->company_margin = 1;
//
//				if( ($diff > $seven_days) && ($diff < $fourteen_days) ) // 14 days
//					$user->company_margin = 3;
//
//				if( ($diff > $fourteen_days) && ($diff < $thirty_days) ) // 30 days
//					$user->company_margin = 5;
//
//				if( $diff > $thirty_days ) // more than 30 days
//					$user->company_margin = 10;
//			}

			$user->password_hash = Yii::$app->security->generatePasswordHash($password);
			$user->generateAuthKey();

			$user->status = 10;

			$user->save(false);

			// the following three lines were added:
			$auth = \Yii::$app->authManager;
			$authorRole = $auth->getRole('user');
			$auth->assign($authorRole, $user->getId());

			return array ($user, $password);
		}

		return null;
	}

	public function attributeLabels()
    {
        return [
            'id' => '№',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patr_name' => 'Отчество',
            'username' => 'Пользователь',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
			'phone' => 'Номер телефона',
            'status' => 'Статус',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Обновлено',

			'password' => 'Пароль',
			'repeat_password' => 'Повторите пароль',

			'rid' => 'Номер Вашего Агента',
            'level' => 'Уровень',
        ];
    }
}
