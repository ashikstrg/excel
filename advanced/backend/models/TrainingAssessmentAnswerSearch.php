<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingAssessmentAnswer;

class TrainingAssessmentAnswerSearch extends TrainingAssessmentAnswer
{
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'question_name', 'answer', 'remark'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TrainingAssessmentAnswer::find();

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
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'question_name', $this->question_name])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
