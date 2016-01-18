<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'scoutid', 'created_at', 'updated_at'], 'integer'],
            [['name', 'subdivision', 'house_number', 'street_name', 'city', 'zip', 'phone', 'drop_location', 'payment_type', 'check_number', 'number_bales', 'order_amount'], 'safe'],
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
    //public function search($params, $scoutidArray)
    public function search($params)
    {
        $query = Order::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

var_dump($params);die;
        $this->load($params);

        if (!$this->validate()) {
var_dump($query);die;
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'scoutid' => [$this->scoutid],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'subdivision', $this->subdivision])
            ->andFilterWhere(['like', 'house_number', $this->house_number])
            ->andFilterWhere(['like', 'street_name', $this->street_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'drop_location', $this->drop_location])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'check_number', $this->check_number])
            ->andFilterWhere(['like', 'number_bales', $this->number_bales])
            ->andFilterWhere(['like', 'order_amount', $this->order_amount]);
        //$query->andFilterWhere(['scoutid' => $scoutidArray]);
        return $dataProvider;
    }
}
