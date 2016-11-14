<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingPdf;

class TrainingPdfSearch extends TrainingPdf
{
    public function rules()
    {
        return [
            [['id', 'batch', 'notification_count'], 'integer'],
            [['name', 'message', 'designations', 'file_import', 'status', 'created_by', 'deleted_by', 'created_at', 'deleted_at', 'training_datetime'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TrainingPdf::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'notification_count' => $this->notification_count,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'training_datetime' => $this->training_datetime,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'designations', $this->designations])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'file_import', $this->file_import])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
