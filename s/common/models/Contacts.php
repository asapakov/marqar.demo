<?php

namespace common\models;

use Yii;

use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property string $phone Номер телефона
 * @property string $fullname ФИО
 * @property int $type
 * @property int $user_id
 * @property int $created_at Время добавления
 *
 * @property User $user
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contacts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'fullname', 'type', 'user_id', 'created_at'], 'required'],
            [['type', 'user_id', 'created_at', 'sent'], 'integer'],
            [['phone'], 'string', 'max' => 16],
            [['phone'], PhoneInputValidator::className()],
           // [['phone'], 'unique', 'message' => 'Этот номер телефон уже был указан кем-то другим.'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот номер телефон уже был указан кем-то другим.'],
            [['fullname'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Номер телефона',
            'fullname' => 'ФИО',
            'type' => 'Тип',
            'user_id' => 'Пользователь',
            'created_at' => 'Время добавления',
            'sent' => 'Уведомление выслано',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getUser_contacts_num($user_id)
    {
        return Contacts::find()->where(['user_id' => $user_id])->count();
    }


    public function getUser_current_contacts_type($user_id)
    {
        $count = Contacts::find()->where(['user_id' => $user_id])->count();

        if ($count <= 20)
            return 1;
        
        if ($count <= 40)
            return 2;
        
        if ($count <= 70)
            return 3;

        if ($count <= 110)
            return 4;

        if ($count <= 160)
            return 5;

        return false;
    }

    

}
