<?php

namespace backend\models;

use Yii;

class Travel extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'travel';
    }

    public function rules()
    {
        return [
            [['reason', 'start_date', 'end_date', 'cost', 'place'], 'required'],
            [['start_date', 'end_date', 'action_date', 'created_at', 'batch', 'line_manager_hr_id', 'line_manager_designation'], 'safe'],
            [['cost'], 'number'],
            [['status'], 'string'],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name', 'line_manager_name'], 'string', 'max' => 80],
            [['hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['place', 'reason'], 'string', 'max' => 550],
            [['line_manager_designation', 'line_manager_employee_type'], 'string', 'max' => 100],
            [['line_manager_employee_id', 'action_by'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hr_employee_id' => 'Employee ID',
            'hr_name' => 'Name',
            'hr_designation' => 'Designation',
            'hr_employee_type' => 'Employee Type',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'place' => 'Place',
            'cost' => 'Cost',
            'line_manager_hr_id' => 'Line Manager ID',
            'line_manager_employee_id' => 'Line Manager ID',
            'line_manager_name' => 'Line Manager Name',
            'status' => 'Status',
            'action_date' => 'Action Date',
            'action_by' => 'Performed By',
            'created_at' => 'Created At',
            'line_manager_designation' => 'LM Designation',
            'line_manager_emplyee' => 'LM Employee Type'
        ];
    }
}
