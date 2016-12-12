<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TargetBatch;

class TargetBatchSearch extends TargetBatch
{
    public function rules()
    {
        return [
            [['id', 'batch'], 'integer'],
            [['file_import', 'target_date', 'status', 'created_by', 'deleted_by', 'created_at', 'deleted_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TargetBatch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }
        
        if(!Yii::$app->session->get('isAdmin')) {
            
            $query->andFilterWhere(['like', 'created_by', Yii::$app->user->identity->username]);
            
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'batch' => $this->batch,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'status' => 'Active'
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'target_date', $this->target_date])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
    
    public function deleted($params)
    {
        $query = TargetBatch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }
        
        if(!Yii::$app->session->get('isAdmin')) {
            
            $query->andFilterWhere(['like', 'created_by', Yii::$app->user->identity->username]);
            
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'batch' => $this->batch,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'status' => 'Deleted'
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'target_date', $this->target_date])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
