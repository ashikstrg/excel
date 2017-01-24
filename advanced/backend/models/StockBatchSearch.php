<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StockBatch;

class StockBatchSearch extends StockBatch
{
    public function rules()
    {
        return [
            [['id', 'batch', 'total_row'], 'integer'],
            [['file_import', 'status', 'created_by', 'deleted_by', 'created_at', 'deleted_at', 'stock_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = StockBatch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('userRole') != 'admin') {
            $query->andFilterWhere([
                'created_by' => Yii::$app->user->identity->username
            ]);
        }
        
        $query->andFilterWhere([
            'status' => 'Active'
        ]);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'batch' => $this->batch,
            'total_row' => $this->total_row,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'stock_date' => $this->stock_date,
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
    
    public function deleted($params)
    {
        $query = StockBatch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('userRole') != 'admin') {
            $query->andFilterWhere([
                'created_by' => Yii::$app->user->identity->username
            ]);
        }
        
        $query->andFilterWhere([
            'status' => 'Deleted'
        ]);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'batch' => $this->batch,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'stock_date' => $this->stock_date,
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
