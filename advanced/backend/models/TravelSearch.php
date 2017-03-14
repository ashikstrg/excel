<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Travel;

class TravelSearch extends Travel
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'start_date', 'end_date', 'place', 'line_manager_employee_id', 'line_manager_name', 'status', 'action_date', 'action_by', 'created_at'], 'safe'],
            [['cost'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Travel::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cost' => $this->cost,
            'action_date' => $this->action_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'line_manager_employee_id', $this->line_manager_employee_id])
            ->andFilterWhere(['like', 'line_manager_name', $this->line_manager_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'action_by', $this->action_by]);
        
        if(\Yii::$app->session->get('userRole') != 'admin') {
            
            $query->andFilterWhere([
                'hr_employee_id' => Yii::$app->session->get('employee_id'),
            ]);
            
        }

        return $dataProvider;
    }
    
    public function manage($params)
    {
        $query = Travel::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cost' => $this->cost,
            'action_date' => $this->action_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'action_by', $this->action_by]);
        
        if(\Yii::$app->session->get('userRole') == 'Sales') {
            
            $query->andFilterWhere([
                'action_by' => Yii::$app->session->get('employee_id'),
            ]);
            
        } if(\Yii::$app->session->get('userRole') == 'admin') {
            
            $query->andFilterWhere([
                'action_by' => Yii::$app->session->get('employee_id'),
            ]);
            
        }

        return $dataProvider;
    }
    
    public function config($params)
    {
        $query = Travel::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cost' => $this->cost,
            'action_date' => $this->action_date,
            'created_at' => $this->created_at,
            'status' => 'Pending'
        ]);

        $query->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'action_by', $this->action_by]);
        
        if(\Yii::$app->session->get('userRole') == 'Sales') {
            
            $query->andFilterWhere([
                'line_manager_employee_id' => Yii::$app->session->get('employee_id'),
            ]);
            
        }

        return $dataProvider;
    }
}
