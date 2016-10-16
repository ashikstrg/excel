<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sales;

class SalesSearch extends Sales
{
    
    public function rules()
    {
        return [
            [['id', 'retail_id', 'tm_parent', 'am_parent', 'csm_parent', 'product_id'], 'integer'],
            [['retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory', 'designation', 'employee_id', 'employee_name', 'tm_employee_id', 'tm_name', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'imei_no', 'sales_date', 'created_at', 'created_by'], 'safe'],
            [['price'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('userRole') == 'FSM') {
            $query->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'TM') {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('tm_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'AM') {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('am_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'CSM') {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('csm_employee_id')
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'retail_id' => $this->retail_id,
            'tm_parent' => $this->tm_parent,
            'am_parent' => $this->am_parent,
            'csm_parent' => $this->csm_parent,
            'product_id' => $this->product_id,
            'price' => $this->price,
            'sales_date' => $this->sales_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'retail_channel_type', $this->retail_channel_type])
            ->andFilterWhere(['like', 'retail_type', $this->retail_type])
            ->andFilterWhere(['like', 'retail_zone', $this->retail_zone])
            ->andFilterWhere(['like', 'retail_area', $this->retail_area])
            ->andFilterWhere(['like', 'retail_territory', $this->retail_territory])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'employee_name', $this->employee_name])
            ->andFilterWhere(['like', 'tm_employee_id', $this->tm_employee_id])
            ->andFilterWhere(['like', 'tm_name', $this->tm_name])
            ->andFilterWhere(['like', 'am_employee_id', $this->am_employee_id])
            ->andFilterWhere(['like', 'am_name', $this->am_name])
            ->andFilterWhere(['like', 'csm_employee_id', $this->csm_employee_id])
            ->andFilterWhere(['like', 'csm_name', $this->csm_name])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
            ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
            ->andFilterWhere(['like', 'product_color', $this->product_color])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'imei_no', $this->imei_no])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
    
    public function national($params)
    {
        $this->load($params);
        
        $yearMonth = date('Y-m', time());
        
        if(!empty($this->sales_date)) {
            $yearMonth = $this->sales_date;
        }
        
        $query = Sales::find()
            ->select([
                'product_type', 'product_model_name', 'product_model_code', 'employee_id', 'tm_employee_id', 'am_employee_id', 'csm_employee_id',
                "sum(case when `sales_date` = '$yearMonth-01' then 1 else 0 end) D01",
                "sum(case when `sales_date` = '$yearMonth-02' then 1 else 0 end) D02",
                "sum(case when `sales_date` = '$yearMonth-03' then 1 else 0 end) D03",
                "sum(case when `sales_date` = '$yearMonth-04' then 1 else 0 end) D04",
                "sum(case when `sales_date` = '$yearMonth-05' then 1 else 0 end) D05",
                "sum(case when `sales_date` = '$yearMonth-06' then 1 else 0 end) D06",
                "sum(case when `sales_date` = '$yearMonth-07' then 1 else 0 end) D07",
                "sum(case when `sales_date` = '$yearMonth-08' then 1 else 0 end) D08",
                "sum(case when `sales_date` = '$yearMonth-09' then 1 else 0 end) D09",
                "sum(case when `sales_date` = '$yearMonth-10' then 1 else 0 end) D10",
                "sum(case when `sales_date` = '$yearMonth-11' then 1 else 0 end) D11",
                "sum(case when `sales_date` = '$yearMonth-12' then 1 else 0 end) D12",
                "sum(case when `sales_date` = '$yearMonth-13' then 1 else 0 end) D13",
                "sum(case when `sales_date` = '$yearMonth-14' then 1 else 0 end) D14",
                "sum(case when `sales_date` = '$yearMonth-15' then 1 else 0 end) D15",
                "sum(case when `sales_date` = '$yearMonth-16' then 1 else 0 end) D16",
                "sum(case when `sales_date` = '$yearMonth-17' then 1 else 0 end) D17",
                "sum(case when `sales_date` = '$yearMonth-18' then 1 else 0 end) D18",
                "sum(case when `sales_date` = '$yearMonth-19' then 1 else 0 end) D19",
                "sum(case when `sales_date` = '$yearMonth-20' then 1 else 0 end) D20",
                "sum(case when `sales_date` = '$yearMonth-21' then 1 else 0 end) D21",
                "sum(case when `sales_date` = '$yearMonth-22' then 1 else 0 end) D22",
                "sum(case when `sales_date` = '$yearMonth-23' then 1 else 0 end) D23",
                "sum(case when `sales_date` = '$yearMonth-24' then 1 else 0 end) D24",
                "sum(case when `sales_date` = '$yearMonth-25' then 1 else 0 end) D25",
                "sum(case when `sales_date` = '$yearMonth-26' then 1 else 0 end) D26",
                "sum(case when `sales_date` = '$yearMonth-27' then 1 else 0 end) D27",
                "sum(case when `sales_date` = '$yearMonth-28' then 1 else 0 end) D28",
                "sum(case when `sales_date` = '$yearMonth-29' then 1 else 0 end) D29",
                "sum(case when `sales_date` = '$yearMonth-30' then 1 else 0 end) D30",
                "sum(case when `sales_date` = '$yearMonth-31' then 1 else 0 end) D31",
                
                "(sum(case when `sales_date` = '$yearMonth-01' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-02' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-03' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-04' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-05' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-06' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-07' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-08' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-09' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-10' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-11' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-12' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-13' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-14' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-15' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-16' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-17' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-18' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-19' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-20' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-21' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-22' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-23' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-24' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-25' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-26' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-27' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-28' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-29' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-30' then 1 else 0 end) +
                sum(case when `sales_date` = '$yearMonth-31' then 1 else 0 end) ) AS total_national",
            ])
            ->groupBy([
                'product_model_code'
                ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('userRole') == 'FSM') {
            $query->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'TM') {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('tm_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'AM') {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('am_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'CSM') {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('csm_employee_id')
            ]);
        }
        
        $query->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
                ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
                ->andFilterWhere(['like', 'product_type', $this->product_type]);

        $dataProvider->setSort([
            'attributes' => [
                'product_type',
                'product_model_name',
                'product_model_code',
                'total_national',
                'D01',
                'D02',
                'D03',
                'D04',
                'D05',
                'D06',
                'D07',
                'D08',
                'D09',
                'D10',
                'D11',
                'D12',
                'D13',
                'D14',
                'D15',
                'D16',
                'D17',
                'D18',
                'D19',
                'D20',
                'D21',
                'D22',
                'D23',
                'D24',
                'D25',
                'D26',
                'D27',
                'D28',
                'D29',
                'D30',
                'D31'
            ]
        ]);
            
        return $dataProvider;
    }
    
    public function national_val($params)
    {
        $this->load($params);
        
        $yearMonth = date('Y-m', time());
        
        if(!empty($this->sales_date)) {
            $yearMonth = $this->sales_date;
        }
        
        $query = Sales::find()
            ->select([
                'product_type', 'product_model_name', 'product_model_code', 'employee_id', 'tm_employee_id', 'am_employee_id', 'csm_employee_id',
                "sum(case when `sales_date` = '$yearMonth-01' then price else 0 end) D01",
                "sum(case when `sales_date` = '$yearMonth-02' then price else 0 end) D02",
                "sum(case when `sales_date` = '$yearMonth-03' then price else 0 end) D03",
                "sum(case when `sales_date` = '$yearMonth-04' then price else 0 end) D04",
                "sum(case when `sales_date` = '$yearMonth-05' then price else 0 end) D05",
                "sum(case when `sales_date` = '$yearMonth-06' then price else 0 end) D06",
                "sum(case when `sales_date` = '$yearMonth-07' then price else 0 end) D07",
                "sum(case when `sales_date` = '$yearMonth-08' then price else 0 end) D08",
                "sum(case when `sales_date` = '$yearMonth-09' then price else 0 end) D09",
                "sum(case when `sales_date` = '$yearMonth-10' then price else 0 end) D10",
                "sum(case when `sales_date` = '$yearMonth-11' then price else 0 end) D11",
                "sum(case when `sales_date` = '$yearMonth-12' then price else 0 end) D12",
                "sum(case when `sales_date` = '$yearMonth-13' then price else 0 end) D13",
                "sum(case when `sales_date` = '$yearMonth-14' then price else 0 end) D14",
                "sum(case when `sales_date` = '$yearMonth-15' then price else 0 end) D15",
                "sum(case when `sales_date` = '$yearMonth-16' then price else 0 end) D16",
                "sum(case when `sales_date` = '$yearMonth-17' then price else 0 end) D17",
                "sum(case when `sales_date` = '$yearMonth-18' then price else 0 end) D18",
                "sum(case when `sales_date` = '$yearMonth-19' then price else 0 end) D19",
                "sum(case when `sales_date` = '$yearMonth-20' then price else 0 end) D20",
                "sum(case when `sales_date` = '$yearMonth-21' then price else 0 end) D21",
                "sum(case when `sales_date` = '$yearMonth-22' then price else 0 end) D22",
                "sum(case when `sales_date` = '$yearMonth-23' then price else 0 end) D23",
                "sum(case when `sales_date` = '$yearMonth-24' then price else 0 end) D24",
                "sum(case when `sales_date` = '$yearMonth-25' then price else 0 end) D25",
                "sum(case when `sales_date` = '$yearMonth-26' then price else 0 end) D26",
                "sum(case when `sales_date` = '$yearMonth-27' then price else 0 end) D27",
                "sum(case when `sales_date` = '$yearMonth-28' then price else 0 end) D28",
                "sum(case when `sales_date` = '$yearMonth-29' then price else 0 end) D29",
                "sum(case when `sales_date` = '$yearMonth-30' then price else 0 end) D30",
                "sum(case when `sales_date` = '$yearMonth-31' then price else 0 end) D31",
                
                "(sum(case when `sales_date` = '$yearMonth-01' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-02' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-03' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-04' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-05' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-06' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-07' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-08' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-09' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-10' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-11' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-12' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-13' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-14' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-15' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-16' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-17' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-18' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-19' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-20' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-21' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-22' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-23' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-24' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-25' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-26' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-27' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-28' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-29' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-30' then price else 0 end) +
                sum(case when `sales_date` = '$yearMonth-31' then price else 0 end) ) AS total_national",
            ])
            ->groupBy([
                'product_model_code'
                ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('userRole') == 'FSM') {
            $query->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'TM') {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('tm_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'AM') {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('am_employee_id')
            ]);
        } else if(Yii::$app->session->get('userRole') == 'CSM') {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('csm_employee_id')
            ]);
        }
        
        $query->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
                ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
                ->andFilterWhere(['like', 'product_type', $this->product_type]);

        $dataProvider->setSort([
            'attributes' => [
                'product_type',
                'product_model_name',
                'product_model_code',
                'total_national',
                'D01',
                'D02',
                'D03',
                'D04',
                'D05',
                'D06',
                'D07',
                'D08',
                'D09',
                'D10',
                'D11',
                'D12',
                'D13',
                'D14',
                'D15',
                'D16',
                'D17',
                'D18',
                'D19',
                'D20',
                'D21',
                'D22',
                'D23',
                'D24',
                'D25',
                'D26',
                'D27',
                'D28',
                'D29',
                'D30',
                'D31'
            ]
        ]);
            
        return $dataProvider;
    }
}
