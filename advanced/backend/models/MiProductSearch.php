<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MiProduct;

class MiProductSearch extends MiProduct
{
    public function rules()
    {
        return [
            [['id', 'sale_out_vol', 'hr_id'], 'integer'],
            [['brand', 'model', 'display_size', 'display_type', 'generation', 'sim', 'weight', 'ram', 'rom', 'processor', 'battery', 'camera_rear', 'camera_front', 'special_feature', 'region', 'district', 'town', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MiProduct::find();

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
            'price' => $this->price,
            'sale_out_vol' => $this->sale_out_vol,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'display_size', $this->display_size])
            ->andFilterWhere(['like', 'display_type', $this->display_type])
            ->andFilterWhere(['like', 'generation', $this->generation])
            ->andFilterWhere(['like', 'sim', $this->sim])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'ram', $this->ram])
            ->andFilterWhere(['like', 'rom', $this->rom])
            ->andFilterWhere(['like', 'processor', $this->processor])
            ->andFilterWhere(['like', 'battery', $this->battery])
            ->andFilterWhere(['like', 'camera_rear', $this->camera_rear])
            ->andFilterWhere(['like', 'camera_front', $this->camera_front])
            ->andFilterWhere(['like', 'special_feature', $this->special_feature])
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
