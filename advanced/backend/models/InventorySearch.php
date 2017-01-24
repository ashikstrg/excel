<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Inventory;

/**
 * InventorySearch represents the model behind the search form about `backend\models\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'batch'], 'integer'],
            [['imei_no', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['lifting_price', 'rrp'], 'number'],
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
        $query = Inventory::find();

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
            'batch' => $this->batch,
            'lifting_price' => $this->lifting_price,
            'rrp' => $this->rrp,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'imei_no', $this->imei_no])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
            ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
            ->andFilterWhere(['like', 'product_color', $this->product_color])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
