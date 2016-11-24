<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingAssessmentCategory;

class TrainingAssessmentCategorySearch extends TrainingAssessmentCategory
{

    public function rules()
    {
        return [ 
            [['id', 'qlimit'], 'integer'],
            [['name', 'message', 'designations', 'date_month', 'notification_count', 'status', 'created_at', 'created_by'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TrainingAssessmentCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'notification_count' => $this->notification_count,
            'qlimit' => $this->qlimit,
            'estimated_time' => $this->estimated_time
        ]);

        $query->andFilterWhere(['like', 'designations', $this->designations])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'date_month', $this->date_month])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
