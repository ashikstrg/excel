<?php

namespace backend\models;

use Yii;

class Training extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'training';
    }

    public function rules()
    {
        return [
            [['batch', 'hr_id', 'hr_employee_id', 'hr_designation', 'hr_employee_type', 'hr_name', 'message', 'training_datetime', 'created_by'], 'required'],
            [['batch', 'hr_id'], 'integer'],
            [['training_datetime', 'created_at', 'updated_at'], 'safe'],
            [['status', 'read_status'], 'string'],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['hr_name'], 'string', 'max' => 80],
            [['message'], 'string', 'max' => 550],
            [['created_by', 'updated_by', 'name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Hr Employee ID',
            'hr_designation' => 'Hr Designation',
            'hr_employee_type' => 'Hr Employee Type',
            'hr_name' => 'Hr Name',
            'message' => 'Message',
            'training_datetime' => 'Training Datetime',
            'status' => 'Status',
            'read_status' => 'Read Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
