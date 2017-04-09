<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sales;

// Custom
use yii\data\SqlDataProvider;

class SalesSearch extends Sales
{
    
    public function rules()
    {
        return [
            [['id', 'retail_id', 'tm_parent', 'am_parent', 'csm_parent', 'product_id'], 'integer'],
            [['retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory', 'designation', 'employee_id', 'employee_name', 'tm_employee_id', 'tm_name', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'imei_no', 'sales_date', 'created_at', 'created_by', 'date_range'], 'safe'],
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
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        if(Yii::$app->session->get('isFSM')) {
            $query->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isTM')) {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
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
            ->andFilterWhere(['like', 'sales_date', $this->sales_date])
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
        } else if(Yii::$app->session->get('isTM')) {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
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
        } else if(Yii::$app->session->get('isTM')) {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
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
    
    public function national_retail($params)
    {
        $this->load($params);
        
        $yearMonth = date('Y-m', time());
        
        if(!empty($this->sales_date)) {
            $yearMonth = $this->sales_date;
        }
        
        $query = Sales::find()
            ->select([
                'retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory', 'employee_id', 'employee_name', 'designation',
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
                sum(case when `sales_date` = '$yearMonth-31' then 1 else 0 end) ) AS total",
            ])
            ->groupBy([
                'hr_id'
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
        } else if(Yii::$app->session->get('isTM')) {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        }
        
        $query->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
                ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
                ->andFilterWhere(['like', 'product_type', $this->product_type]);

        $dataProvider->setSort([
            'attributes' => [
                'retail_dms_code', 
                'retail_name', 
                'retail_type', 
                'retail_channel_type', 
                'retail_zone', 
                'retail_area', 
                'retail_territory', 
                'employee_id', 
                'employee_name', 
                'designation',
                'total',
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
    
    public function national_fsm_value($params)
    {
        $this->load($params);
        
        $yearMonth = date('Y-m', time());
        
        if(!empty($this->sales_date)) {
            $yearMonth = $this->sales_date;
        }
        
        $query = Sales::find()
            ->select([
                'retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory', 'employee_id', 'employee_name', 'designation',
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
                sum(case when `sales_date` = '$yearMonth-31' then price else 0 end) ) AS total",
            ])
            ->groupBy([
                'hr_id'
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
        } else if(Yii::$app->session->get('isTM')) {
            $query->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $query->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $query->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        }
        
        $query->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
                ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
                ->andFilterWhere(['like', 'product_type', $this->product_type]);

        $dataProvider->setSort([
            'attributes' => [
                'retail_dms_code', 
                'retail_name', 
                'retail_type', 
                'retail_channel_type', 
                'retail_zone', 
                'retail_area', 
                'retail_territory', 
                'employee_id', 
                'employee_name', 
                'designation',
                'total',
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
    
    public function retail_model($params)
    {
        $salesDateMonth = null;
        $salesDateYear = null;
        
        $this->load($params);
        
        if(empty($this->retail_dms_code)) {
            $this->retail_dms_code = null;
        }
        
        if(empty($this->retail_name)) {
            $this->retail_name = null;
        }
        
        if(empty($this->retail_type)) {
            $this->retail_type = null;
        }
        
        if(empty($this->retail_channel_type)) {
            $this->retail_channel_type = null;
        }
        
        if(empty($this->retail_area)) {
            $this->retail_area = null;
        }
        
        if(empty($this->retail_zone)) {
            $this->retail_zone = null;
        }
        
        if(empty($this->retail_territory)) {
            $this->retail_territory = null;
        }
        
        if(empty($this->employee_id)) {
            $this->employee_id = null;
        }
        
        if(empty($this->employee_name)) {
            $this->employee_name = null;
        }
        
        if(empty($this->designation)) {
            $this->designation = null;
        }
        
        
        
        $dateRange = array();
        $dateRange[0] = null;
        $dateRange[1] = null;
        $salesDateYear = null;
        $salesDateMonth = null;
        if(!empty($this->date_range)) {
            
            $dateRange = explode(' to ', $this->date_range);
            
        } else if(!empty($this->sales_date)) {
            
            $monthYear = explode('-', $this->sales_date);
            $salesDateYear = $monthYear[0];
            $salesDateMonth = $monthYear[1];
            
        } else {
            
            $this->sales_date = date('Y-m', time());
            $salesDateYear = date('Y', time());
            $salesDateMonth = date('m', time());
            
        }
        
        if(Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        } else if(Yii::$app->session->get('isAM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = Yii::$app->session->get('employee_id');
            $this->csm_employee_id = null;
        } else if(Yii::$app->session->get('isCSM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        } else {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        }
        
        $retailDmsCode = $this->retail_dms_code;
        $retailName = $this->retail_name;
        $retailType = $this->retail_type;
        $retailChannelType = $this->retail_channel_type;
        $retailZone = $this->retail_zone;
        $retailArea = $this->retail_area;
        $retailTerritory = $this->retail_territory;
        $employeeId = $this->employee_id;
        $employeeName = $this->employee_name;
        $designation = $this->designation;    
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT employee_id) FROM sales WHERE (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)")
                ->bindValue(':tm_employee_id', $this->tm_employee_id)
                ->bindValue(':am_employee_id', $this->am_employee_id)
                ->bindValue(':csm_employee_id', $this->csm_employee_id)
			->queryScalar();
        
        $sql= "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', 1, 0)) AS ',
                        CONCAT('`', `product_model_name`, '`')
                    )
                )
            INTO @sql
            FROM sales;
            SET @sql = CONCAT('SELECT @i:=@i+1 `#`, retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, ', @sql, ', COUNT(id) AS total
            FROM sales, (SELECT @i:= 0) AS i
            WHERE (retail_dms_code=:retail_dms_code or :retail_dms_code is null)
            AND (retail_name like :retail_name or :retail_name is null)
            AND (retail_type like :retail_type or :retail_type is null)
            AND (retail_channel_type like :retail_channel_type or :retail_channel_type is null)
            AND (retail_zone like :retail_zone or :retail_zone is null)
            AND (retail_area like :retail_area or :retail_area is null)
            AND (retail_territory like :retail_territory or :retail_territory is null)
            AND (employee_id like :employee_id or :employee_id is null)
            AND (employee_name like :employee_name or :employee_name is null)
            AND (designation like :designation or :designation is null)
            AND ((MONTH(sales_date)=:sales_date_month or :sales_date_month is NULL) AND (YEAR(sales_date)=:sales_date_year or :sales_date_year is null))
            AND ((sales_date>=:start_date OR :start_date IS NULL) AND (sales_date<=:end_date OR :end_date is NULL))
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY employee_id ORDER BY `#`');";

        $cmd  = Yii::$app->db->createCommand($sql); 
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();
        
        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();       
        
        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':retail_dms_code' => $retailDmsCode,
                ':retail_name' => '%' . $retailName . '%',
                ':retail_type' => '%' . $retailType . '%',
                ':retail_channel_type' => '%' . $retailChannelType . '%',
                ':retail_zone' => '%' . $retailZone . '%',
                ':retail_area' => '%' . $retailArea . '%',
                ':retail_territory' => '%' . $retailTerritory . '%',
                ':employee_id' => '%' . $employeeId . '%',
                ':employee_name' => '%' . $employeeName . '%',
                ':designation' => '%' . $designation . '%',
                ':sales_date_month' => $salesDateMonth,
                ':sales_date_year' => $salesDateYear,
                ':tm_employee_id' => $this->tm_employee_id,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id,
                ':start_date' => $dateRange[0],
                ':end_date' => $dateRange[1]
            ],
            'totalCount' => $totalCount,
            'sort' =>false,
//            'sort' => [
//                'defaultOrder' => ['id'=>SORT_ASC],
//                'attributes' => [
//                    'retail_dms_code' => [
//                        'asc' => ['retail_dms_code' => SORT_ASC],
//                        'desc' => ['retail_dms_code' => SORT_DESC],
//                    ],
//                    'retail_name' => [
//                        'asc' => ['retail_name' => SORT_ASC],
//                        'desc' => ['retail_name' => SORT_DESC],
//                    ],
//                    'retail_type' => [
//                        'asc' => ['retail_type' => SORT_ASC],
//                        'desc' => ['retail_type' => SORT_DESC],
//                    ],
//                    'retail_channel_type' => [
//                        'asc' => ['retail_channel_type' => SORT_ASC],
//                        'desc' => ['retail_channel_type' => SORT_DESC],
//                    ],
//                    'retail_zone' => [
//                        'asc' => ['retail_zone' => SORT_ASC],
//                        'desc' => ['retail_zone' => SORT_DESC],
//                    ],
//                    'retail_area' => [
//                        'asc' => ['retail_area' => SORT_ASC],
//                        'desc' => ['retail_area' => SORT_DESC],
//                    ],
//                    'retail_territory' => [
//                        'asc' => ['retail_territory' => SORT_ASC],
//                        'desc' => ['retail_territory' => SORT_DESC],
//                    ],
//                    'employee_id' => [
//                        'asc' => ['employee_id' => SORT_ASC],
//                        'desc' => ['employee_id' => SORT_DESC],
//                    ],
//                    'employee_name' => [
//                        'asc' => ['employee_name' => SORT_ASC],
//                        'desc' => ['employee_name' => SORT_DESC],
//                    ],
//                    'designation' => [
//                        'asc' => ['designation' => SORT_ASC],
//                        'desc' => ['designation' => SORT_DESC],
//                    ],
//                    'total' => [
//                        'asc' => ['total' => SORT_ASC],
//                        'desc' => ['total' => SORT_DESC],
//                    ],
//                ],
//            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $dataProvider;
    }
    
    public function retail_model_value($params)
    {
        $salesDateMonth = null;
        $salesDateYear = null;
        
        $this->load($params);
        
        if(empty($this->retail_dms_code)) {
            $this->retail_dms_code = null;
        }
        
        if(empty($this->retail_name)) {
            $this->retail_name = null;
        }
        
        if(empty($this->retail_type)) {
            $this->retail_type = null;
        }
        
        if(empty($this->retail_channel_type)) {
            $this->retail_channel_type = null;
        }
        
        if(empty($this->retail_area)) {
            $this->retail_area = null;
        }
        
        if(empty($this->retail_zone)) {
            $this->retail_zone = null;
        }
        
        if(empty($this->retail_territory)) {
            $this->retail_territory = null;
        }
        
        if(empty($this->employee_id)) {
            $this->employee_id = null;
        }
        
        if(empty($this->employee_name)) {
            $this->employee_name = null;
        }
        
        if(empty($this->designation)) {
            $this->designation = null;
        }
        
        
        
        $dateRange = array();
        $dateRange[0] = null;
        $dateRange[1] = null;
        $salesDateYear = null;
        $salesDateMonth = null;
        if(!empty($this->date_range)) {
            
            $dateRange = explode(' to ', $this->date_range);
            
        } else if(!empty($this->sales_date)) {
            
            $monthYear = explode('-', $this->sales_date);
            $salesDateYear = $monthYear[0];
            $salesDateMonth = $monthYear[1];
            
        } else {
            
            $this->sales_date = date('Y-m', time());
            $salesDateYear = date('Y', time());
            $salesDateMonth = date('m', time());
            
        }
        
        if(Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        } else if(Yii::$app->session->get('isAM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = Yii::$app->session->get('employee_id');
            $this->csm_employee_id = null;
        } else if(Yii::$app->session->get('isCSM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        } else {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        }
        
        $retailDmsCode = $this->retail_dms_code;
        $retailName = $this->retail_name;
        $retailType = $this->retail_type;
        $retailChannelType = $this->retail_channel_type;
        $retailZone = $this->retail_zone;
        $retailArea = $this->retail_area;
        $retailTerritory = $this->retail_territory;
        $employeeId = $this->employee_id;
        $employeeName = $this->employee_name;
        $designation = $this->designation;    
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT employee_id) FROM sales WHERE (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)")
                ->bindValue(':tm_employee_id', $this->tm_employee_id)
                ->bindValue(':am_employee_id', $this->am_employee_id)
                ->bindValue(':csm_employee_id', $this->csm_employee_id)
			->queryScalar();
        
        $sql= "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', price, 0)) AS ',
                        CONCAT('`', `product_model_name`, '`')
                    )
                )
            INTO @sql
            FROM sales;
            SET @sql = CONCAT('SELECT @i:=@i+1 `#`, retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, ', @sql, ', SUM(price) AS total
            FROM sales, (SELECT @i:= 0) AS i
            WHERE (retail_dms_code=:retail_dms_code or :retail_dms_code is null)
            AND (retail_name like :retail_name or :retail_name is null)
            AND (retail_type like :retail_type or :retail_type is null)
            AND (retail_channel_type like :retail_channel_type or :retail_channel_type is null)
            AND (retail_zone like :retail_zone or :retail_zone is null)
            AND (retail_area like :retail_area or :retail_area is null)
            AND (retail_territory like :retail_territory or :retail_territory is null)
            AND (employee_id like :employee_id or :employee_id is null)
            AND (employee_name like :employee_name or :employee_name is null)
            AND (designation like :designation or :designation is null)
            AND ((MONTH(sales_date)=:sales_date_month or :sales_date_month is NULL) AND (YEAR(sales_date)=:sales_date_year or :sales_date_year is null))
            AND ((sales_date>=:start_date OR :start_date IS NULL) AND (sales_date<=:end_date OR :end_date is NULL))
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY employee_id ORDER BY `#`'); ";

        $cmd  = Yii::$app->db->createCommand($sql); 
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();
        
        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();       
        
        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':retail_dms_code' => $retailDmsCode,
                ':retail_name' => '%' . $retailName . '%',
                ':retail_type' => '%' . $retailType . '%',
                ':retail_channel_type' => '%' . $retailChannelType . '%',
                ':retail_zone' => '%' . $retailZone . '%',
                ':retail_area' => '%' . $retailArea . '%',
                ':retail_territory' => '%' . $retailTerritory . '%',
                ':employee_id' => '%' . $employeeId . '%',
                ':employee_name' => '%' . $employeeName . '%',
                ':designation' => '%' . $designation . '%',
                ':sales_date_month' => $salesDateMonth,
                ':sales_date_year' => $salesDateYear,
                ':tm_employee_id' => $this->tm_employee_id,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id,
                ':start_date' => $dateRange[0],
                ':end_date' => $dateRange[1]
            ],
            'totalCount' => $totalCount,
            'sort' =>false,
//            'sort' => [
//                'defaultOrder' => ['sl'=>SORT_ASC],
//                'attributes' => [
//                    'retail_dms_code' => [
//                        'asc' => ['retail_dms_code' => SORT_ASC],
//                        'desc' => ['retail_dms_code' => SORT_DESC],
//                    ],
//                    'retail_name' => [
//                        'asc' => ['retail_name' => SORT_ASC],
//                        'desc' => ['retail_name' => SORT_DESC],
//                    ],
//                    'retail_type' => [
//                        'asc' => ['retail_type' => SORT_ASC],
//                        'desc' => ['retail_type' => SORT_DESC],
//                    ],
//                    'retail_channel_type' => [
//                        'asc' => ['retail_channel_type' => SORT_ASC],
//                        'desc' => ['retail_channel_type' => SORT_DESC],
//                    ],
//                    'retail_zone' => [
//                        'asc' => ['retail_zone' => SORT_ASC],
//                        'desc' => ['retail_zone' => SORT_DESC],
//                    ],
//                    'retail_area' => [
//                        'asc' => ['retail_area' => SORT_ASC],
//                        'desc' => ['retail_area' => SORT_DESC],
//                    ],
//                    'retail_territory' => [
//                        'asc' => ['retail_territory' => SORT_ASC],
//                        'desc' => ['retail_territory' => SORT_DESC],
//                    ],
//                    'employee_id' => [
//                        'asc' => ['employee_id' => SORT_ASC],
//                        'desc' => ['employee_id' => SORT_DESC],
//                    ],
//                    'employee_name' => [
//                        'asc' => ['employee_name' => SORT_ASC],
//                        'desc' => ['employee_name' => SORT_DESC],
//                    ],
//                    'designation' => [
//                        'asc' => ['designation' => SORT_ASC],
//                        'desc' => ['designation' => SORT_DESC],
//                    ],
//                    'total' => [
//                        'asc' => ['total' => SORT_ASC],
//                        'desc' => ['total' => SORT_DESC],
//                    ],
//                    'sl' => [
//                        'asc' => ['sl' => SORT_ASC],
//                        'desc' => ['sl' => SORT_DESC],
//                    ],
//                ],
//            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $dataProvider;
    }
    
}
