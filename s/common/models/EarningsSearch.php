<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SurveysItems;

/**
 * SurveysItemsSearch represents the model behind the search form of `frontend\models\SurveysItems`.
 */
class EarningsSearch extends Earnings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
			[['amount'], 'number'],
            [['description'], 'safe'],
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
        $query = Earnings::find();

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
            'user_id' => $this->user_id,
            'type' => $this->type,
			'amount'  => $this->amount,
            'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
	
	
	public function searchlast3($params)
    {
        $query = Earnings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false // important
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
            'user_id' => $this->user_id,
            'type' => $this->type,
			'amount'  => $this->amount,
            'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
		$query->limit(3);
		$query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
	
}
