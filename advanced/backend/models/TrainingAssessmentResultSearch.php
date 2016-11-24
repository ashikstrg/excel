<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingAssessmentResult;

class TrainingAssessmentResultSearch extends TrainingAssessmentResult
{
    public function rules()
    {
        return [
            [['id', 'category_id', 'score', 'total_time', 'right_answer', 'wrong_answer', 'un_answer'], 'integer'],
            [['hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'date_month', 'participation_datetime', 'status'], 'safe'],
            [['score_percent'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TrainingAssessmentResult::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'score' => $this->score,
            'right_answer' => $this->right_answer,
            'wrong_answer' => $this->wrong_answer,
            'un_answer' => $this->score,
            'score_percent' => $this->score_percent,
            'total_time' => $this->total_time,
            'date_month' => $this->date_month,
            'participation_datetime' => $this->participation_datetime,
        ]);

        $query->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
