<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StockBatch;

/**
 * StockBatchSearch represents the model behind the search form about `backend\models\StockBatch`.
 */
class StockBatchSearch extends StockBatch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'batch'], 'integer'],
            [['file_import', 'status', 'created_by', 'deleted_by', 'created_at', 'deleted_at', 'stock_date'], 'safe'],
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
        $query = StockBatch::find();

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
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'stock_date' => $this->stock_date,
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
