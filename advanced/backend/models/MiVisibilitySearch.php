<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MiVisibility;

class MiVisibilitySearch extends MiVisibility
{

    public function rules()
    {
        return [
            [['id', 'hr_id'], 'integer'],
            [['brand', 'model', 'posm', 'image', 'image_src_filename', 'image_web_filename', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MiVisibility::find();

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
            ->andFilterWhere(['like', 'posm', $this->posm])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_src_filename', $this->image_src_filename])
            ->andFilterWhere(['like', 'image_web_filename', $this->image_web_filename])
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
            
        }

        return $dataProvider;
    }
}
