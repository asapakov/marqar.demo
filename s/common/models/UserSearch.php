<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $fullName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'ref_id'], 'integer'],
            [['fullName', 'first_name', 'last_name', 'patr_name', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'bitcoin_wallet', 'advcash_wallet', 'payeer_wallet', 'perfectmoney_wallet', 'secret_question', 'secret_answer'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
			'ref_id' => $this->ref_id,
            'id_num' => $this->id_num,
            'iin' => $this->iin,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'patr_name', $this->patr_name])
			->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'iin', $this->iin])
            ->andFilterWhere(['like', 'date_birth', $this->date_birth])
            ->andFilterWhere(['like', 'id_givenby', $this->id_givenby])
			->andFilterWhere(['like', 'id_validdate', $this->id_validdate]);

        //kbb 01.02.22 5:40
//        $this->addCondition($query, 'first_name', true);
//        $this->addCondition($query, 'last_name', true);

        // filter by person full name
        $query->andWhere('first_name LIKE "%' . $this->fullName . '%" ' .
            'OR last_name LIKE "%' . $this->fullName . '%" ' .
            'OR patr_name LIKE "%' . $this->fullName . '%"'
        );
        //kbb end

        $messageLog = [
            'status' => 'Поиск по таблице user',
            'query' => $query
        ];
        Yii::info($messageLog, 'process');

        return $dataProvider;
    }

    public static function get_user_rewards($user_id)
    {
        $rewards_sum = User::find()->where(['ref_id'=>$user_id])->andWhere(['can_left'=>1])->count() * 16;

        return $rewards_sum;
    }
}
