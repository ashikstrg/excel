<?php

namespace backend\models;

use Yii;

class Notification extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'notification';
    }

    public function rules()
    {
        return [
            [['name', 'module_name', 'url', 'hr_id', 'hr_employee_id', 'hr_designation', 'hr_employee_type', 'hr_name', 'message', 'created_by', 'image_web_filename', 'created_by_name', 'batch'], 'required'],
            [['hr_id', 'batch'], 'integer'],
            [['read_status'], 'string'],
            [['seen', 'created_at'], 'safe'],
            [['name', 'url', 'created_by', 'image_web_filename', 'created_by_name'], 'string', 'max' => 255],
            [['module_name', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name'], 'string', 'max' => 80],
            [['message'], 'string', 'max' => 550],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Notification',
            'module_name' => 'Module Name',
            'url' => 'URL',
            'hr_id' => 'HR ID',
            'hr_employee_id' => 'HR Employee ID',
            'hr_designation' => 'HR Designation',
            'hr_employee_type' => 'HR Employee Type',
            'hr_name' => 'HR Name',
            'message' => 'Message',
            'read_status' => 'Read Status',
            'seen' => 'Seen At',
            'created_at' => 'Sent At',
            'created_by' => 'Sent By',
            'image_web_filename' =>'Image',
            'created_by_name' => 'Sent By',
            'batch' => 'Batch'
        ];
    }
}
