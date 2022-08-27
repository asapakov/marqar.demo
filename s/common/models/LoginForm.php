<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
	
	public function attributeLabels() //zyx
  	{
    	return [
      		'username' => 'Пользователь',
      		'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
  	}

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();			
			
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильно указанные Логин или Пароль');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        //kbb 11.02.22 0:58
//        if (($this->username == 'love94-2010@mail.ru') || $this->validate( )) { //zyx
        if ($this->validate( )) { //zyx
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            // kbb 31.01.22 2:43
			if (ctype_digit($this->username)) {
                $this->_user = User::findIdentity($this->username);
            } else {
                $this->_user = User::findByUsername($this->username);
            }
        }

        return $this->_user;
    }
}
