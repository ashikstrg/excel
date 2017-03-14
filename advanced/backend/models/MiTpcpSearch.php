<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MiTpcp;

class MiTpcpSearch extends MiTpcp
{
    public function rules()
    {
        return [
            [['id', 'hr_id'], 'integer'],
            [['brand', 'model', 'trade_promo', 'consumer_promo', 'fsm_incentive_plan', 'other_scheme', 'region', 'district', 'town', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MiTpcp::find();

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
            'hr_id' => $this->hr_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'trade_promo', $this->trade_promo])
            ->andFilterWhere(['like', 'consumer_promo', $this->consumer_promo])
            ->andFilterWhere(['like', 'fsm_incentive_plan', $this->fsm_incentive_plan])
            ->andFilterWhere(['like', 'other_scheme', $this->other_scheme])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'am_employee_id', $this->am_employee_id])
            ->andFilterWhere(['like', 'am_name', $this->am_name])
            ->andFilterWhere(['like', 'csm_employee_id', $this->csm_employee_id])
            ->andFilterWhere(['like', 'csm_name', $this->csm_name]);
        
        if(Yii::$app->session->get('isTM')) {
            
            $query->andFilterWhere([
                'hr_employee_id' => Yii::$app->session->get('employee_id')
            ]);
            
        } else if(Yii::$app->session->get('isAM')) {
            
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
            
        } else if(Yii::$app->session->get('userRole') == 'Trainer') {
            
            $query->andFilterWhere([
                'hr_employee_id' => Yii::$app->session->get('employee_id')
            ]);
            
        }

        return $dataProvider;
    }
}
