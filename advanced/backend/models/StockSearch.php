<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stock;

// Custom Model
use backend\models\Hr;

// Custom
use yii\data\SqlDataProvider;

class StockSearch extends Stock
{

    public function rules()
    {
        return [
            [['id', 'batch', 'retail_id', 'product_id', 'status'], 'integer'],
            [['retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory', 'imei_no', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'submission_date', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $hrModel = null;
        
        if(Yii::$app->session->get('isFSM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isTM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['tm_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isAM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['am_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isCSM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['csm_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        }
        
        $query = Stock::find();

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
        
        $query->andFilterWhere([
            'retail_id' => $hrModel,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'batch' => $this->batch,
            'status' => $this->status,
            'submission_date' => $this->submission_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'retail_type', $this->retail_type])
            ->andFilterWhere(['like', 'retail_channel_type', $this->retail_channel_type])
            ->andFilterWhere(['like', 'retail_zone', $this->retail_zone])
            ->andFilterWhere(['like', 'retail_area', $this->retail_area])
            ->andFilterWhere(['like', 'retail_territory', $this->retail_territory])
            ->andFilterWhere(['like', 'imei_no', $this->imei_no])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
            ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
            ->andFilterWhere(['like', 'product_color', $this->product_color])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
    
    public function searchDaily($params)
    {
        $hrModel = null;
        $hr = array();
        $hrString = '';
        
        if(Yii::$app->session->get('isFSM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isTM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['tm_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isAM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['am_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        } else if(Yii::$app->session->get('isCSM')) {
            
            $hrModel = Hr::find()->select('retail_id')->where(['csm_employee_id' => Yii::$app->session->get('employee_id')])->all();
            
        }
        
        if(!empty($hrModel)) {
            foreach($hrModel as $value){
                $hr[] = $value->retail_id;
            }
        }

        $hrString = implode(',', $hr);
        
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
        
//        if(empty($this->submission_date)) {
//            $this->submission_date = date('Y-m-d', time());
//        }
        
        $retailDmsCode = $this->retail_dms_code;
        $retailName = $this->retail_name;
        $retailType = $this->retail_type;
        $retailChannelType = $this->retail_channel_type;
        $retailZone = $this->retail_zone;
        $retailArea = $this->retail_area;
        $retailTerritory = $this->retail_territory;
        //$submissionDate = $this->submission_date;
        
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(DISTINCT retail_dms_code) FROM stock')
			->queryScalar();
        
        $sql= "SET @sql = NULL;
            SELECT
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', 1, 0)) AS ',
                        product_model_code
                    )
                ) INTO @sql
            FROM stock;
            SET @sql2 = NULL;
            SELECT
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_type = ''',
                        product_type,
                        ''', 1, 0)) AS ',
                        product_type
                    )
                )
            INTO @sql2
            FROM stock;
            SET @sql3 = NULL;
            SELECT 
                COUNT(imei_no) AS `total`
            INTO @sql3
            FROM stock;
            SET @sql = CONCAT('SELECT @i:=@i+1 `#`, retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, retail_territory, ', @sql, ', ', @sql2, ', COUNT(imei_no) AS total FROM stock, (SELECT @i:= 0) AS i WHERE 
            (retail_dms_code=:retail_dms_code or :retail_dms_code is null)
            AND (retail_name like :retail_name or :retail_name is null)
            AND (retail_type like :retail_type or :retail_type is null)
            AND (retail_channel_type like :retail_channel_type or :retail_channel_type is null)
            AND (retail_zone like :retail_zone or :retail_zone is null)
            AND (retail_area like :retail_area or :retail_area is null)
            AND (retail_territory like :retail_territory or :retail_territory is null)
            AND (retail_id IN (:retail_id))
            GROUP BY retail_dms_code'); ";

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
                ':retail_id' => $hrString
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'attributes' => [
                    'retail_dms_code' => [
                        'asc' => ['retail_dms_code' => SORT_ASC],
                        'desc' => ['retail_dms_code' => SORT_DESC],
                    ],
                    'retail_name' => [
                        'asc' => ['retail_name' => SORT_ASC],
                        'desc' => ['retail_name' => SORT_DESC],
                    ],
                    'retail_type' => [
                        'asc' => ['retail_type' => SORT_ASC],
                        'desc' => ['retail_type' => SORT_DESC],
                    ],
                    'retail_channel_type' => [
                        'asc' => ['retail_channel_type' => SORT_ASC],
                        'desc' => ['retail_channel_type' => SORT_DESC],
                    ],
                    'retail_zone' => [
                        'asc' => ['retail_zone' => SORT_ASC],
                        'desc' => ['retail_zone' => SORT_DESC],
                    ],
                    'retail_area' => [
                        'asc' => ['retail_area' => SORT_ASC],
                        'desc' => ['retail_area' => SORT_DESC],
                    ],
                    'retail_territory' => [
                        'asc' => ['retail_territory' => SORT_ASC],
                        'desc' => ['retail_territory' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $dataProvider;
    }
}
