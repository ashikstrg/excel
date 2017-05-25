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
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
    
    public function trend_achv_model($params) {
        
        $this->load($params);

        if (Yii::$app->session->get('isFSM')) {
            $this->employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isAM')) {
            $this->am_employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isCSM')) {
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        $dataProvider = Target::find()
                ->select(["CONCAT(product_model_name, ' (', product_model_code, ')') AS product_model_name",
                    'SUM(fsm_vol) AS fsm_vol', 'SUM(fsm_vol_sales) AS fsm_vol_sales',
                    'case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end AS achievement_percent'])
                ->andFilterWhere(['like', 'target_date', $this->target_date])
                ->andFilterWhere([
                    'employee_id' => $this->employee_id,
                    'tm_employee_id' => $this->tm_employee_id,
                    'am_employee_id' => $this->am_employee_id,
                    'csm_employee_id' => $this->csm_employee_id
                ])
                ->groupBy(['product_model_code'])
                ->all();

        return $dataProvider;
    }
    
    public function trend_achv_model_val($params) {
        
        $this->load($params);

        if (Yii::$app->session->get('isFSM')) {
            $this->employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isAM')) {
            $this->am_employee_id = Yii::$app->session->get('employee_id');
        } else if (Yii::$app->session->get('isCSM')) {
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        $dataProvider = Target::find()
                ->select(["CONCAT(product_model_name, ' (', product_model_code, ')') AS product_model_name",
                    'SUM(fsm_val) AS fsm_val', 'SUM(fsm_val_sales) AS fsm_val_sales',
                    'case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end AS achievement_percent'])
                ->andFilterWhere(['like', 'target_date', $this->target_date])
                ->andFilterWhere([
                    'employee_id' => $this->employee_id,
                    'tm_employee_id' => $this->tm_employee_id,
                    'am_employee_id' => $this->am_employee_id,
                    'csm_employee_id' => $this->csm_employee_id
                ])
                ->groupBy(['product_model_code'])
                ->all();

        return $dataProvider;
    }

    public function trend_achievement($params)
    {
        $this->load($params);
        
        if(Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
        } else if(Yii::$app->session->get('isAM')) {
            $this->am_employee_id = Yii::$app->session->get('employee_id');
        } else if(Yii::$app->session->get('isCSM')) {
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        }
        
        if(empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }
        
        $dataProvider = Target::find()
                ->select(["CONCAT(`employee_name`, ' - ', employee_id, ' (', designation, ')') AS employee_id", 
                    'SUM(fsm_vol) AS fsm_vol', 'SUM(fsm_vol_sales) AS fsm_vol_sales',
                    'case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end AS achievement_percent'])
                ->andFilterWhere(['like', 'target_date', $this->target_date])
                ->andFilterWhere([
                    'tm_employee_id' => $this->tm_employee_id,
                    'am_employee_id' => $this->am_employee_id,
                    'csm_employee_id' => $this->csm_employee_id
                        ])
                ->groupBy(['hr_id'])
                ->all();

        return $dataProvider;
    }
    
    public function trend_achievement_value($params)
    {
        $this->load($params);
        
        if(Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
        } else if(Yii::$app->session->get('isAM')) {
            $this->am_employee_id = Yii::$app->session->get('employee_id');
        } else if(Yii::$app->session->get('isCSM')) {
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        }
        
        if(empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }
        
        $dataProvider = Target::find()
                ->select(["CONCAT(`employee_name`, ' - ', employee_id, ' (', designation, ')') AS employee_id", 'SUM(fsm_val) AS fsm_val', 'SUM(fsm_val_sales) AS fsm_val_sales',
                    'case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end AS achievement_percent'])
                ->andFilterWhere(['like', 'target_date', $this->target_date])
                ->andFilterWhere([
                    'tm_employee_id' => $this->tm_employee_id,
                    'am_employee_id' => $this->am_employee_id,
                    'csm_employee_id' => $this->csm_employee_id
                        ])
                ->groupBy(['hr_id'])
                ->all();

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
        
        if(empty($this->tm_employee_id)) {
            $tmEmployeeId = null;
        } else {
            $tmEmployeeId = $this->tm_employee_id;
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
        $targetDate = $this->target_date;
        $targetDateFullFormat = $targetDate.'-01';
        
        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDateFullFormat])->distinct()->all();
        
        
        if(!empty($targetProductModel)) {
            foreach($targetProductModel as $value){
                $product[] = $value->product_model_code;
            }
        }  
        
        $productString = '"'.implode('","', $product).'"';
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT employee_id) FROM target WHERE (retail_dms_code=:retail_dms_code or :retail_dms_code is null)
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (tm_employee_id=:tmEmployeeId or :tmEmployeeId is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null);")
                ->bindValue(':retail_dms_code', $retailDmsCode)
                ->bindValue(':retail_name', '%' . $retailName . '%')
                ->bindValue(':retail_type', '%' . $retailType . '%')
                ->bindValue(':retail_channel_type', '%' . $retailChannelType . '%')
                ->bindValue(':retail_zone', '%' . $retailZone . '%')
                ->bindValue(':retail_area', '%' . $retailArea . '%')
                ->bindValue(':retail_territory', '%' . $retailTerritory . '%')
                ->bindValue(':employee_id', '%' . $employeeId . '%')
                ->bindValue(':employee_name', '%' . $employeeName . '%')
                ->bindValue(':designation', '%' . $designation . '%')
                ->bindValue(':target_date', $targetDate.'-01')
                ->bindValue(':tm_employee_id', $this->tm_employee_id)
                ->bindValue(':tmEmployeeId', $tmEmployeeId)
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
                        ''', fsm_vol_sales, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, tm_employee_id, tm_name, SUM(fsm_vol) AS total_target, SUM(fsm_vol_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end ,2), \"%\") AS achievement_percent,
            ', @sql, '
            FROM target 
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (tm_employee_id=:tmEmployeeId or :tmEmployeeId is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
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
                ':target_date' => $targetDate.'-01',
                ':tm_employee_id' => $this->tm_employee_id,
                ':tmEmployeeId' => $tmEmployeeId,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent'=>SORT_DESC],
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
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
    
    public function leaderboard_am($params) {
        
        $product = array();

        $this->load($params);

        if (empty($this->am_employee_id)) {
            $this->am_employee_id = null;
        }

        if (empty($this->am_name)) {
            $this->am_name = null;
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        if (Yii::$app->session->get('isCSM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        } else {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        }

        $AmEmployeeId = $this->am_employee_id;
        $AmName = $this->am_name;
        $targetDate = $this->target_date;

        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate . '-01'])->distinct()->all();


        if (!empty($targetProductModel)) {
            foreach ($targetProductModel as $value) {
                $product[] = $value->product_model_code;
            }
        }

        $productString = '"' . implode('","', $product) . '"';

        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT am_employee_id) FROM target WHERE 
           csm_employee_id=:csm_employee_id or :csm_employee_id is null")
                ->bindValue(':csm_employee_id', $this->csm_employee_id)
                ->queryScalar();

        $sql = "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', am_vol_sales, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT am_employee_id, am_name, SUM(am_vol) AS total_target, SUM(am_vol_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(am_vol)=0 then 0 else ( SUM(am_vol_sales)/SUM(am_vol))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
            WHERE (am_employee_id like :am_employee_id or :am_employee_id is null)
            AND (am_name like :am_name or :am_name is null)
            AND (product_model_code IN ($productString))
            AND (target_date=:target_date)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY am_employee_id');";

        $cmd = Yii::$app->db->createCommand($sql);
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();

        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();

        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':am_employee_id' => '%' . $AmEmployeeId . '%',
                ':am_name' => '%' . $AmName . '%',
                ':target_date' => $targetDate . '-01',
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent' => SORT_DESC],
                'attributes' => [
                    'am_employee_id' => [
                        'asc' => ['am_employee_id' => SORT_ASC],
                        'desc' => ['am_employee_id' => SORT_DESC],
                    ],
                    'am_name' => [
                        'asc' => ['am_name' => SORT_ASC],
                        'desc' => ['am_name' => SORT_DESC],
                    ],
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
    
    public function leaderboard_value_am($params) {
        $product = array();

        $this->load($params);

        if (empty($this->am_employee_id)) {
            $this->am_employee_id = null;
        }

        if (empty($this->am_name)) {
            $this->am_name = null;
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        if (Yii::$app->session->get('isCSM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = Yii::$app->session->get('employee_id');
        } else {
            $this->tm_employee_id = null;
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        }

        $retailTerritory = $this->retail_territory;
        $AmEmployeeId = $this->am_employee_id;
        $AmName = $this->tm_name;
        $targetDate = $this->target_date;

        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate . '-01'])->distinct()->all();


        if (!empty($targetProductModel)) {
            foreach ($targetProductModel as $value) {
                $product[] = $value->product_model_code;
            }
        }

        $productString = '"' . implode('","', $product) . '"';

        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT tm_employee_id) FROM target WHERE 
            (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)")
                ->bindValue(':am_employee_id', $this->am_employee_id)
                ->bindValue(':csm_employee_id', $this->csm_employee_id)
                ->queryScalar();

        $sql = "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', am_val_sales, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT am_employee_id, am_name, SUM(am_val) AS total_target, 
            SUM(am_val_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(am_val)=0 then 0 else ( SUM(am_val_sales)/SUM(am_val))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
            WHERE (am_employee_id like :am_employee_id or :am_employee_id is null)
            AND (am_name like :am_name or :am_name is null)
            AND (product_model_code IN ($productString))
            AND (target_date=:target_date)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY am_employee_id'); ";

        $cmd = Yii::$app->db->createCommand($sql);
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();

        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();

        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':am_employee_id' => '%' . $AmEmployeeId . '%',
                ':am_name' => '%' . $AmName . '%',
                ':target_date' => $targetDate . '-01',
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent' => SORT_DESC],
                'attributes' => [
                    'am_employee_id' => [
                        'asc' => ['am_employee_id' => SORT_ASC],
                        'desc' => ['am_employee_id' => SORT_DESC],
                    ],
                    'am_name' => [
                        'asc' => ['am_name' => SORT_ASC],
                        'desc' => ['am_name' => SORT_DESC],
                    ],
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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

    public function leaderboard_tm($params)
    {
        $product = array();
        
        $this->load($params);
        
        if(empty($this->retail_territory)) {
            $this->retail_territory = null;
        }
        
        if(empty($this->tm_employee_id)) {
            $this->tm_employee_id = null;
        }
        
        if(empty($this->tm_name)) {
            $this->tm_name = null;
        }
        
        if(empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }
        
        if(Yii::$app->session->get('isAM')) {
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
        
        $retailTerritory = $this->retail_territory;
        $TmEmployeeId = $this->tm_employee_id;
        $TmName = $this->tm_name;
        $designation = $this->designation;
        $targetDate = $this->target_date;
        
        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate.'-01'])->distinct()->all();
        
        
        if(!empty($targetProductModel)) {
            foreach($targetProductModel as $value){
                $product[] = $value->product_model_code;
            }
        }  
        
        $productString = '"'.implode('","', $product).'"';
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT tm_employee_id) FROM target WHERE 
            (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)")
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
                        ''', tm_vol_sales, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_territory, tm_employee_id, tm_name, SUM(tm_vol) AS total_target, SUM(tm_vol_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(tm_vol)=0 then 0 else ( SUM(tm_vol_sales)/SUM(tm_vol))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
            WHERE (retail_territory like :retail_territory or :retail_territory is null)
            AND (tm_employee_id like :tm_employee_id or :tm_employee_id is null)
            AND (tm_name like :tm_name or :tm_name is null)
            AND (product_model_code IN ($productString))
            AND (target_date=:target_date)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY tm_employee_id'); ";

        $cmd  = Yii::$app->db->createCommand($sql); 
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();
        
        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();       
        
        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':retail_territory' => '%' . $retailTerritory . '%',
                ':tm_employee_id' => '%' . $TmEmployeeId . '%',
                ':tm_name' => '%' . $TmName . '%',
                ':target_date' => $targetDate.'-01',
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent'=>SORT_DESC],
                'attributes' => [
                    'retail_territory' => [
                        'asc' => ['retail_territory' => SORT_ASC],
                        'desc' => ['retail_territory' => SORT_DESC],
                    ],
                    'tm_employee_id' => [
                        'asc' => ['tm_employee_id' => SORT_ASC],
                        'desc' => ['tm_employee_id' => SORT_DESC],
                    ],
                    'tm_name' => [
                        'asc' => ['tm_name' => SORT_ASC],
                        'desc' => ['tm_name' => SORT_DESC],
                    ],
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
    
    public function leaderboard_value_tm($params)
    {
        $product = array();
        
        $this->load($params);
        
        if(empty($this->retail_territory)) {
            $this->retail_territory = null;
        }
        
        if(empty($this->tm_employee_id)) {
            $this->tm_employee_id = null;
        }
        
        if(empty($this->tm_name)) {
            $this->tm_name = null;
        }
        
        if(empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }
        
        if(Yii::$app->session->get('isAM')) {
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
        
        $retailTerritory = $this->retail_territory;
        $TmEmployeeId = $this->tm_employee_id;
        $TmName = $this->tm_name;
        $targetDate = $this->target_date;
        
        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate.'-01'])->distinct()->all();
        
        
        if(!empty($targetProductModel)) {
            foreach($targetProductModel as $value){
                $product[] = $value->product_model_code;
            }
        }  
        
        $productString = '"'.implode('","', $product).'"';
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT tm_employee_id) FROM target WHERE 
            (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)")
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
                        ''', tm_val_sales, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_territory, tm_employee_id, tm_name, SUM(tm_val) AS total_target, 
            SUM(tm_val_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(tm_val)=0 then 0 else ( SUM(tm_val_sales)/SUM(tm_val))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
            WHERE (retail_territory like :retail_territory or :retail_territory is null)
            AND (tm_employee_id like :tm_employee_id or :tm_employee_id is null)
            AND (tm_name like :tm_name or :tm_name is null)
            AND (product_model_code IN ($productString))
            AND (target_date=:target_date)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY tm_employee_id'); ";

        $cmd  = Yii::$app->db->createCommand($sql); 
        $cmd->execute();
        $cmd->pdoStatement->closeCursor();
        
        $cmd1 = Yii::$app->db->createCommand('SELECT @sql;');
        $result = $cmd1->queryOne();       
        
        $dataProvider = new SqlDataProvider([
            'sql' => $result['@sql'],
            'params' => [
                ':retail_territory' => '%' . $retailTerritory . '%',
                ':tm_employee_id' => '%' . $TmEmployeeId . '%',
                ':tm_name' => '%' . $TmName . '%',
                ':target_date' => $targetDate.'-01',
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent'=>SORT_DESC],
                'attributes' => [
                    'retail_territory' => [
                        'asc' => ['retail_territory' => SORT_ASC],
                        'desc' => ['retail_territory' => SORT_DESC],
                    ],
                    'tm_employee_id' => [
                        'asc' => ['tm_employee_id' => SORT_ASC],
                        'desc' => ['tm_employee_id' => SORT_DESC],
                    ],
                    'tm_name' => [
                        'asc' => ['tm_name' => SORT_ASC],
                        'desc' => ['tm_name' => SORT_DESC],
                    ],
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
    
    public function achv($params) {
        $product = array();

        $this->load($params);

        if (empty($this->retail_dms_code)) {
            $this->retail_dms_code = null;
        }

        if (empty($this->retail_name)) {
            $this->retail_name = null;
        }

        if (empty($this->retail_type)) {
            $this->retail_type = null;
        }

        if (empty($this->retail_channel_type)) {
            $this->retail_channel_type = null;
        }

        if (empty($this->retail_area)) {
            $this->retail_area = null;
        }

        if (empty($this->retail_zone)) {
            $this->retail_zone = null;
        }

        if (empty($this->retail_territory)) {
            $this->retail_territory = null;
        }

        if (empty($this->employee_id)) {
            $this->employee_id = null;
        }

        if (empty($this->employee_name)) {
            $this->employee_name = null;
        }

        if (empty($this->designation)) {
            $this->designation = null;
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        if (Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        } else if (Yii::$app->session->get('isAM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = Yii::$app->session->get('employee_id');
            $this->csm_employee_id = null;
        } else if (Yii::$app->session->get('isCSM')) {
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
        $targetDate = $this->target_date;

        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate . '-01'])->distinct()->all();


        if (!empty($targetProductModel)) {
            foreach ($targetProductModel as $value) {
                $product[] = $value->product_model_code;
            }
        }

        $productString = '"' . implode('","', $product) . '"';

        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(DISTINCT employee_id) FROM target')
                ->queryScalar();

        $sql = "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', fsm_vol, 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, SUM(fsm_vol) AS total_target, SUM(fsm_vol_sales) AS total_achievement,
            CONCAT(FORMAT(case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY employee_id'); ";

        $cmd = Yii::$app->db->createCommand($sql);
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
                ':target_date' => $targetDate . '-01',
                ':tm_employee_id' => $this->tm_employee_id,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent' => SORT_DESC],
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
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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

    public function leaderboard_value($params)
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
        
        if(empty($this->tm_employee_id)) {
            $tmEmployeeId = null;
        } else {
            $tmEmployeeId = $this->tm_employee_id;
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
        $targetDate = $this->target_date;
        $targetDateFullFormat = $targetDate.'-01';
        
        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDateFullFormat])->distinct()->all();
        
        
        if(!empty($targetProductModel)) {
            foreach($targetProductModel as $value){
                $product[] = $value->product_model_code;
            }
        }  
        
        $productString = '"'.implode('","', $product).'"';
        
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(DISTINCT employee_id) FROM target WHERE (retail_dms_code=:retail_dms_code or :retail_dms_code is null)
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (tm_employee_id=:tmEmployeeId or :tmEmployeeId is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null);")
                ->bindValue(':retail_dms_code', $retailDmsCode)
                ->bindValue(':retail_name', '%' . $retailName . '%')
                ->bindValue(':retail_type', '%' . $retailType . '%')
                ->bindValue(':retail_channel_type', '%' . $retailChannelType . '%')
                ->bindValue(':retail_zone', '%' . $retailZone . '%')
                ->bindValue(':retail_area', '%' . $retailArea . '%')
                ->bindValue(':retail_territory', '%' . $retailTerritory . '%')
                ->bindValue(':employee_id', '%' . $employeeId . '%')
                ->bindValue(':employee_name', '%' . $employeeName . '%')
                ->bindValue(':designation', '%' . $designation . '%')
                ->bindValue(':target_date', $targetDate.'-01')
                ->bindValue(':tm_employee_id', $this->tm_employee_id)
                ->bindValue(':tmEmployeeId', $tmEmployeeId)
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
                        ''', FORMAT(fsm_val_sales, 2), 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, tm_employee_id, tm_name, FORMAT(SUM(fsm_val), 2) AS total_target, FORMAT(SUM(fsm_val_sales), 2) AS total_achievement,
            CONCAT(FORMAT(case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (tm_employee_id=:tmEmployeeId or :tmEmployeeId is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
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
                ':target_date' => $targetDate.'-01',
                ':tm_employee_id' => $this->tm_employee_id,
                ':tmEmployeeId' => $tmEmployeeId,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent'=>SORT_DESC],
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
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
    
    public function achv_val($params) {
        $product = array();

        $this->load($params);

        if (empty($this->retail_dms_code)) {
            $this->retail_dms_code = null;
        }

        if (empty($this->retail_name)) {
            $this->retail_name = null;
        }

        if (empty($this->retail_type)) {
            $this->retail_type = null;
        }

        if (empty($this->retail_channel_type)) {
            $this->retail_channel_type = null;
        }

        if (empty($this->retail_area)) {
            $this->retail_area = null;
        }

        if (empty($this->retail_zone)) {
            $this->retail_zone = null;
        }

        if (empty($this->retail_territory)) {
            $this->retail_territory = null;
        }

        if (empty($this->employee_id)) {
            $this->employee_id = null;
        }

        if (empty($this->employee_name)) {
            $this->employee_name = null;
        }

        if (empty($this->designation)) {
            $this->designation = null;
        }

        if (empty($this->target_date)) {
            $this->target_date = date('Y-m', time());
        }

        if (Yii::$app->session->get('isTM')) {
            $this->tm_employee_id = Yii::$app->session->get('employee_id');
            $this->am_employee_id = null;
            $this->csm_employee_id = null;
        } else if (Yii::$app->session->get('isAM')) {
            $this->tm_employee_id = null;
            $this->am_employee_id = Yii::$app->session->get('employee_id');
            $this->csm_employee_id = null;
        } else if (Yii::$app->session->get('isCSM')) {
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
        $targetDate = $this->target_date;

        $targetProductModel = Target::find()->select('product_model_code')->where(['target_date' => $targetDate . '-01'])->distinct()->all();


        if (!empty($targetProductModel)) {
            foreach ($targetProductModel as $value) {
                $product[] = $value->product_model_code;
            }
        }

        $productString = '"' . implode('","', $product) . '"';

        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(DISTINCT employee_id) FROM target')
                ->queryScalar();

        $sql = "SET @sql = NULL;
            SET @@group_concat_max_len = 6000000;
            SELECT 
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(IF(product_model_code = ''',
                        product_model_code,
                        ''', FORMAT(fsm_val, 2), 0)) AS ',
                        CONCAT('`', product_model_name, '`')
                    )
                )
            INTO @sql
            FROM target;
            SET @sql = CONCAT('SELECT retail_dms_code, retail_name, retail_type, retail_channel_type, retail_zone, retail_area, 
            retail_territory, employee_id, employee_name, designation, FORMAT(SUM(fsm_val), 2) AS total_target, FORMAT(SUM(fsm_val_sales), 2) AS total_achievement,
            CONCAT(FORMAT(case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end ,2), \"%\") AS achievement_percent, ', @sql, ' 
            FROM target 
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
            AND (tm_employee_id=:tm_employee_id or :tm_employee_id is null)
            AND (am_employee_id=:am_employee_id or :am_employee_id is null)
            AND (csm_employee_id=:csm_employee_id or :csm_employee_id is null)
            GROUP BY employee_id'); ";

        $cmd = Yii::$app->db->createCommand($sql);
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
                ':target_date' => $targetDate . '-01',
                ':tm_employee_id' => $this->tm_employee_id,
                ':am_employee_id' => $this->am_employee_id,
                ':csm_employee_id' => $this->csm_employee_id
            ],
            'totalCount' => $totalCount,
            //'sort' =>false, to remove the table header sorting
            'sort' => [
                'defaultOrder' => ['achievement_percent' => SORT_DESC],
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
                    'total_target' => [
                        'asc' => ['total_target' => SORT_ASC],
                        'desc' => ['total_target' => SORT_DESC],
                    ],
                    'total_achievement' => [
                        'asc' => ['total_achievement' => SORT_ASC],
                        'desc' => ['total_achievement' => SORT_DESC],
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
