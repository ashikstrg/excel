<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AttendanceChecklist;

class AttendanceChecklistSearch extends AttendanceChecklist
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['checklist', 'retail_dms_code', 'retail_name', 'hr_employee_id', 'hr_name', 'checklist_date', 'in_time', 'out_time', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AttendanceChecklist::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'checklist_date' => $this->checklist_date,
            'in_time' => $this->in_time,
            'out_time' => $this->out_time,
        ]);

        $query->andFilterWhere(['like', 'checklist', $this->checklist])
            ->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
