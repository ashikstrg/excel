<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Target;

// Custom
use yii\data\SqlDataProvider;

class TargetSearch extends Target
{
    public function rules()
    {
        return [
            [['id', 'batch', 'retail_id', 'hr_id', 'fsm_vol', 'tm_parent', 'tm_vol', 'am_parent', 'am_vol', 'csm_parent', 'csm_vol'], 'integer'],
            [['retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory', 'employee_id', 'employee_name', 'designation', 'tm_employee_id', 'tm_name', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'product_name', 'product_model_code', 'product_model_name', 'product_type', 'target_date', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['fsm_val', 'tm_val', 'am_val', 'csm_val'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Target::find();

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
            'batch' => $this->batch,
            'retail_id' => $this->retail_id,
            'hr_id' => $this->hr_id,
            'fsm_vol' => $this->fsm_vol,
            'fsm_val' => $this->fsm_val,
            'tm_parent' => $this->tm_parent,
            'tm_vol' => $this->tm_vol,
            'tm_val' => $this->tm_val,
            'am_parent' => $this->am_parent,
            'am_vol' => $this->am_vol,
            'am_val' => $this->am_val,
            'csm_parent' => $this->csm_parent,
            'csm_vol' => $this->csm_vol,
            'csm_val' => $this->csm_val,
            'target_date' => $this->target_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'retail_channel_type', $this->retail_channel_type])
            ->andFilterWhere(['like', 'retail_type', $this->retail_type])
            ->andFilterWhere(['like', 'retail_zone', $this->retail_zone])
            ->andFilterWhere(['like', 'retail_area', $this->retail_area])
            ->andFilterWhere(['like', 'retail_territory', $this->retail_territory])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'employee_name', $this->employee_name])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'tm_employee_id', $this->tm_employee_id])
            ->andFilterWhere(['like', 'tm_name', $this->tm_name])
            ->andFilterWhere(['like', 'am_employee_id', $this->am_employee_id])
            ->andFilterWhere(['like', 'am_name', $this->am_name])
            ->andFilterWhere(['like', 'csm_employee_id', $this->csm_employee_id])
            ->andFilterWhere(['like', 'csm_name', $this->csm_name])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_model_code', $this->product_model_code])
            ->andFilterWhere(['like', 'product_model_name', $this->product_model_name])
            ->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
    
    public function leaderboard($params)
    {
        $product = array();
        
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
        
        if(empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
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
        $targetDate = $this->target_date;
        
        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate.'-01'])->distinct()->all();
        
        
        if(!empty($targetProductModel)) {
            foreach($targetProductModel as $value){
                $product[] = $value->product_model_code;
            }
        }  
        
        $productString = '"'.implode('","', $product).'"';
        
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(DISTINCT employee_id) FROM target')
			->queryScalar();
        
        $sql= "SET @sql = NULL;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'MAX(IF(product_model_code = ''',
                        product_model_code,
                        ''', fsm_vol, 0)) AS ',
                        product_model_code
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT @i:=@i+1 `#`, retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, ', @sql, ', SUM(fsm_vol) AS total_target, SUM(fsm_vol_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end ,2), \"%\") AS achievement_percent 
            FROM target, (SELECT @i:= 0) AS i 
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
            AND (product_model_code IN ($productString))
            AND (target_date=:target_date)
            GROUP BY employee_id'); ";

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
                ':target_date' => $targetDate.'-01'
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent'=>SORT_ASC],
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
                    'employee_id' => [
                        'asc' => ['employee_id' => SORT_ASC],
                        'desc' => ['employee_id' => SORT_DESC],
                    ],
                    'employee_name' => [
                        'asc' => ['employee_name' => SORT_ASC],
                        'desc' => ['employee_name' => SORT_DESC],
                    ],
                    'designation' => [
                        'asc' => ['designation' => SORT_ASC],
                        'desc' => ['designation' => SORT_DESC],
                    ],
                    'achievement_percent' => [
                        'asc' => ['achievement_percent' => SORT_ASC],
                        'desc' => ['achievement_percent' => SORT_DESC],
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
