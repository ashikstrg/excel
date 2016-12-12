<?php

namespace backend\models;

use Yii;

class MiTpcp extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mi_tpcp';
    }

    public function rules()
    {
        return [
            [['brand', 'model', 'trade_promo', 'consumer_promo', 'fsm_incentive_plan', 'other_scheme', 'region', 'district', 'town', 'hr_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at'], 'required'],
            [['hr_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand', 'model', 'trade_promo', 'consumer_promo', 'fsm_incentive_plan', 'other_scheme', 'region', 'district', 'town', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['hr_employee_id', 'am_employee_id', 'csm_employee_id'], 'string', 'max' => 50],
            [['hr_name', 'am_name', 'csm_name'], 'string', 'max' => 80],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'trade_promo' => 'Trade Promo',
            'consumer_promo' => 'Consumer Promo',
            'fsm_incentive_plan' => 'FSM Incentive Plan',
            'other_scheme' => 'Other Scheme',
            'region' => 'Region',
            'district' => 'District',
            'town' => 'Town',
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Hr Employee ID',
            'hr_name' => 'Hr Name',
            'hr_designation' => 'Hr Designation',
            'hr_employee_type' => 'Hr Employee Type',
            'am_employee_id' => 'Am Employee ID',
            'am_name' => 'Am Name',
            'csm_employee_id' => 'Csm Employee ID',
            'csm_name' => 'Csm Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
