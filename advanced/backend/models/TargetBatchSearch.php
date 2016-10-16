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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if(!Yii::$app->session->get('isAdmin')) {
            
            $query->andFilterWhere(['like', 'created_by', Yii::$app->user->identity->username]);
            
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'batch' => $this->batch,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'target_date', $this->target_date])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
