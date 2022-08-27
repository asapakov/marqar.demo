<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


use borales\extensions\phoneInput\PhoneInputValidator;
/**
 * User model
 *
 * @property integer $id
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $countryCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            //'phoneInput' => PhoneInputBehavior::className(),
            //'countryCodeAttribute' => 'countryCode',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'ref_id', 'card_validdate_month', 'card_validdate_year', 'left_cell', 'can_left', 'left_points', 'right_cell', 'can_right', 'right_points', 'parent_user_id', 'level', 'etalon_id', 'reg_order'], 'integer'],
            
            [['first_name', 'last_name', 'patr_name', 'username', 'password_hash', 'password_reset_token', 'email', 'id_givenby', 'card_name', 'country', 'city', 'street', 'house', 'apartment'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 16, 'min' => 12],
            [['phone'], PhoneInputValidator::className()],
            [['iin'], 'string', 'max' => 12, 'min' => 12],
            [['id_num'], 'string', 'max' => 9, 'min' => 9],
            [['card_num'], 'string', 'max' => 16, 'min' => 16],
            
            [['left_money', 'right_money'], 'number'],
            
            [['date_birth', 'id_validdate'], 'safe'],
            //kbb 06.02.2022 7:42
            [['username'], 'unique'],
//            [['username', 'phone'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'АН',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patr_name' => 'Отчество',
            //kbb 01.02.22 5:36
            'fullName' => 'ФИО',

            'username' => 'Пользователь',
            'iin' => 'ИИН / №паспорта',
            'date_birth' => 'Дата рождения',
            'id_num' => '№ Уд. личности',
            'id_givenby' => 'Орган выдачи уд. личности',
            'id_validdate' => 'Срок дейстия уд. личности',
            'card_num' => '№ карты',
            'card_validdate_month' => 'Срок годности (месяц)',
            'card_validdate_year' => 'Срок годности (год)',
            'card_name' => 'Имя на карте',
            'country' => 'Страна',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'apartment' => 'Квартира',

            'left_points' => 'Баллы в левой ветке',
            'right_points' => 'Баллы в правой ветке',
            'left_money' => 'Деньги в левой ветке',
            'left_money' => 'Деньги в правой ветке',
            
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Статус',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Обновлено',
			
			// 'ref_id' => 'Пригласивший',  //kbb 07.05.22
			'ref_id' => 'АН продавца',
            'etalon_id' => 'Оригинал',
            'phone' => 'Номер телефона',
            'secret_question' => 'Secret Question',
            'secret_answer' => 'Secret Answer',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }



    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    //kbb 01.02.22 5:17
    public function getFullName()
    {
        return $this->last_name.' '.$this->first_name.' '.$this->patr_name;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function get_balance($user)
    {
        // all Earnings SUM
		$earnings_sum = Earnings::find()->where(['user_id'=>$user])->andWhere(['status'=>1])->sum('amount');
		
		// all withdrawals SUM
		$withdrawals_sum = Withdrawals::find()->where(['user_id'=>$user])->andWhere(['status'=>1])->sum('amount');
		
		$res = $earnings_sum - $withdrawals_sum;
		
		return $res;
    }


    public function findplace($user_id)
    {
        //var_dump($user_id);
        //exit;

		$accept = User::find()
            ->where(['and',
                ['left_cell' => 0],
                ['can_left' => 1]
            ])
            ->orWhere(['and',
                ['right_cell' => 0],
                ['can_right' => 1]
            ])
            ->andWhere(['<>','id', $user_id])
            ->orderBy(['reg_order' => SORT_ASC])->one();

        //kbb 06.02.22 6:39
        $messageLog = [
            'status' => 'Найден родитель к которому прикрепляется пользователь',
            '$accept' => $accept
        ];
        Yii::info($messageLog, 'process');
        
        if(($accept->left_cell == 0) && ($accept->can_left == 1)) {

            $accept->left_cell = $user_id;
        }  else {

            $accept->right_cell = $user_id;
        }

        $max_reg_oder = User::find()->max('reg_order');

        if($accept->save(false)) {
            //kbb 06.02.22 6:39
            $messageLog = [
                'status' => 'Обновление родителя успешно',
                '$accept' => $accept
            ];
            Yii::info($messageLog, 'process');

            $user = User::findOne($user_id);
                $user->parent_user_id = $accept->id;
                $user->level = $accept->level + 1;
                $user->reg_order = $max_reg_oder + 1;
                //kbb 08.05.22 1:23
                $user->activated_at = time();
            if ($user->save(false)) {
                //kbb 06.02.22 6:39
                $messageLog = [
                    'status' => 'Обновление пользователя произведено успешно',
                    '$user' => $user
                ];
                Yii::info($messageLog, 'process');
            } else {
                //kbb 06.02.22 6:39
                $messageLog = [
                    'status' => 'Ошибка сохранения пользователя',
                    'error' => $user->getErrors()
                ];
                Yii::info($messageLog, 'process');
            }

            $user->addtreepoints($accept->id, $user_id, $user_id);

            //kbb 02.03.22 0:56
            Earnings::add_agents_commission($user->ref_id, $user_id);

            User::check_add_user_create($user->ref_id);
            

        } else {
            //kbb 06.02.22 6:39
            $messageLog = [
                'status' => 'Ошибка сохранения родителя',
                'error' => $accept->getErrors()
            ];
            Yii::info($messageLog, 'process');

            echo '<pre>';
            var_dump($accept->id, $accept->errors);
            exit;
        }

    }

    //Добавить данные о количестве людей и денег в ветке для получателя $accept_id по пользователю $user_id
    public function addtreepoints($accept_id, $user_id, $starter_id)
    {
		
        // заработки за месяц
        $month_earnings_sum = Earnings::find()->where(['user_id'=>$accept_id])->andWhere( 'created_at > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 MONTH))')->sum('amount');

        if ($accept_id && $user_id) {
            $user = User::findOne($accept_id);
            if($user) {
               
                
                // если пользователь в левой ветке
                if($user->left_cell == $user_id) {
                    
                    // добавляем денег в левую ветку
                    $user->addmoneyleft($accept_id, 50);

                    // добавляем пользователя в левую ветку
                    $user->left_points++;

                    $messageLog = [
                        'status' => 'Добавляем денег родителю в левую ветку и кол-во пользователей слева',
                        '$user' => $user
                    ];
                    Yii::info($messageLog, 'process');

                    // Если левая ветка меньше
                    if($user->left_points <= $user->right_points) {
                        
                        // и если заработок меньше 5000 за месяц, то добавляем бинарный бонус получателю 
                        if($month_earnings_sum < 5000) {
                            Earnings::addbinarbonus($accept_id, $starter_id);
                        }

                        // После начислений получателю проверяем выполнил ли он условие по первым $500
                        Earnings::checkfirst500($accept_id);
                        // Также проверяем большой бонус для получателя по деньгам в малой ветке
                        Withdrawals::check_big_bonus($accept_id, $user->left_money);
                    }
                    
                }
                
                 // если пользователь в правой ветке
                if($user->right_cell == $user_id) {

                    $user->addmoneyright($accept_id, 50);
                    $user->right_points++;

                    $messageLog = [
                        'status' => 'Добавляем денег родителю в правую ветку и кол-во пользователей справа',
                        '$user' => $user
                    ];
                    Yii::info($messageLog, 'process');


                    if($user->right_points <= $user->left_points) {
                        
                        if($month_earnings_sum < 5000) {
                            Earnings::addbinarbonus($accept_id, $starter_id);
                        }

                        Earnings::checkfirst500($accept_id);
                        Withdrawals::check_big_bonus($accept_id, $user->right_money);
                    }
                }

                if($user->save(false)) {
                    if($user->parent_user_id == 0)
                        return true;
                    $user->addtreepoints($user->parent_user_id, $user->id, $starter_id);
                } else {
                    $messageLog = [
                        'status' => 'Ошибка сохранения родителя',
                        'error' => $user->getErrors()
                    ];
                    Yii::info($messageLog, 'process');

                    echo '<pre>';
                    var_dump($user->id, $user->errors);
                    exit;
                }

            } else {
                $messageLog = [
                    'status' => 'Не найден пользователь для добавления баллов для добавления баллов.',
                    'accept_id' => $accept_id
                ];
                Yii::info($messageLog, 'process');

                Yii::$app->session->setFlash('error', 'Не найден пользователь для добавления баллов для добавления баллов.');
                return false;
            }

        } else {
            $messageLog = [
                'status' => 'Переданы не все параметры для добавления баллов.',
                'accept_id' => $accept_id,
                'user_id' => $user_id
            ];
            Yii::info($messageLog, 'process');

            Yii::$app->session->setFlash('error', 'Переданы не все параметры для добавления баллов.');
            return false;
        }
    }


    public function allcoditions($user_id)
    {
		$user = User::findOne($user_id);
        
        // было 
        // $contacts_num = Contacts::find()->where(['user_id' => $user_id])->count();

        // $date_ok = User::find()->where(['id' => $user_id])->andWhere( 'created_at > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 14 DAY))')->one();

        // if($user->phone && ($contacts_num == 20) && ($date_ok)) {

        //     if($user->can_right == 0) {
        //         $user->can_right = 1;
        //         $user->save(false);
        //     }
            
        //     return true;
        // }

        // стало
        // kbb 10.10.22 12:20
        // $ref_num = User::find()->where(['ref_id' => $user_id])->count();
        // if($ref_num == 12) {

        //     if($user->can_right == 0) {
        //         $user->can_right = 1;
        //         $user->save(false);
        //     }
            
        //     return true;
        // }

        return false;
    }



    public function addmoneyleft($user_id, $summ)
    {
		$user = User::findOne($user_id);
        $user->left_money += $summ;

        if ($user->save(false))
            return $user->left_money;
        
        return false;
    }



    public function addmoneyright($user_id, $summ)
    {
		$user = User::findOne($user_id);
        $user->right_money += $summ;

        if ($user->save(false))
            return $user->right_money;
        
        return false;
    }


    



    public function get_add_users($user_id)
    {
        $count = User::find()->where(['etalon_id' => $user_id])->count();

        return $count;
    }


    public function get_invited_users($user_id)
    {
        $count = User::find()->where(['ref_id' => $user_id, 'can_left' => 1])->count();

        return $count;
    }


    public function check_add_user_create($user_id)
    {
        $count = User::find()->where(['ref_id' => $user_id, 'can_left' => 1])->count();
        
        if ($count == 20) {
            User::create_add_user($user_id, 2);
            //Yii::$app->session->setFlash('success', 'Поздравляем, для вас был создан дополнительный пользователь.');

            $messageLog = [
                'status' => 'Поздравляем, для вас был создан дополнительный пользователь.',
                'count' => $count
            ];
            Yii::info($messageLog, 'process');

            return true;
        }
            
        if ($count == 50) {
            User::create_add_user($user_id, 3);
            //Yii::$app->session->setFlash('success', 'Поздравляем, для вас был создан дополнительный пользователь.');

            $messageLog = [
                'status' => 'Поздравляем, для вас был создан дополнительный пользователь.',
                'count' => $count
            ];
            Yii::info($messageLog, 'process');

            return true;
        }
            
        if ($count == 90) {
            User::create_add_user($user_id, 4);
            //Yii::$app->session->setFlash('success', 'Поздравляем, для вас был создан дополнительный пользователь.');

            $messageLog = [
                'status' => 'Поздравляем, для вас был создан дополнительный пользователь.',
                'count' => $count
            ];
            Yii::info($messageLog, 'process');

            return true;
        }
            
        if ($count == 140) {
            User::create_add_user($user_id, 5);
            //Yii::$app->session->setFlash('success', 'Поздравляем, для вас был создан дополнительный пользователь.');

            $messageLog = [
                'status' => 'Поздравляем, для вас был создан дополнительный пользователь.',
                'count' => $count
            ];
            Yii::info($messageLog, 'process');

            return true;
        }
            
        return false;
    }



    public function create_add_user($etalon_id, $num)
    {
        $etalon = User::findOne($etalon_id);

        $newUser = new User();
            //$newUser->setAttributes($etalon->attributes);
            $newUser->attributes = $etalon->attributes;

            $newUser->username = stristr($etalon->username, '@', true);
            if(!$newUser->username)
                $newUser->username = $etalon->username;
            $newUser->username = $newUser->username.$num;

            $newUser->phone = '';
            $newUser->etalon_id = $etalon_id;

            $newUser->left_cell = 0;
            $newUser->can_left = 1;
            $newUser->left_points = 0;
            $newUser->left_money = 0;

            $newUser->right_cell = 0;
            $newUser->can_right = 1;
            $newUser->right_points = 0;
            $newUser->right_money = 0;
            
            
            $newUser->parent_user_id = 0;
            $newUser->level = 999999999999;

            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
			$max = 10;
			$size = StrLen($chars)-1;
			$password = null;
			while($max--)
				$password.=$chars[rand(0,$size)];

            $newUser->password_hash = Yii::$app->security->generatePasswordHash($password);
			$newUser->generateAuthKey();
            
        if($newUser->save(false)) {
            User::findplace($newUser->id);

        } else {
            echo '<pre>';
            var_dump($newUser->errors);
            exit;
        }

		$auth = \Yii::$app->authManager;
		$authorRole = $auth->getRole('user');
		$auth->assign($authorRole, $newUser->getId());

        Yii::$app->mailer->compose()
						->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
						->setTo($newUser->email)
						->setSubject('Создан дополнительный пользователь - ' . Yii::$app->name)
						->setTextBody('Поздравляем! Для вас создан дополнительный пользователь на сайте Markhar.com!
Для входа на сайт пожалуйста, используйте следующие данные:
Логин: '.$newUser->username.'
Пароль: '.$password)
    					->setHtmlBody('<p><b>Поздравляем! Для вас создан дополнительный пользователь на сайте Markhar.com!</p>
                        <p>Для входа на сайт пожалуйста, используйте следующие данные:<br>
                        Логин: '.$newUser->username.'<br>
                        Пароль: '.$password.'<br>
                        </p>
                        ')
		->send();
    }

}
