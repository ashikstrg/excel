<?php

namespace backend\models;

use Yii;

class AttendanceChecklist extends \yii\db\ActiveRecord
{

    public static $statusPending = 'Pending';
    public static $statusApproved = 'Approved';
    public static $statusDeclined = 'Declined';
    
    public static function tableName()
    {
        return 'attendance_checklist';
    }

    public function rules()
    {
        return [
            [['checklist', 'retail_dms_code', 'retail_name', 'hr_employee_id', 'hr_name', 'checklist_date', 'in_time', 'status'], 'required'],
            [['checklist', 'status'], 'string'],
            [['checklist_date', 'in_time', 'out_time'], 'safe'],
            [['retail_dms_code'], 'string', 'max' => 100],
            [['retail_name'], 'string', 'max' => 150],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'checklist' => 'Checklist',
            'retail_dms_code' => 'Dms Code',
            'retail_name' => 'Retail Name',
            'hr_employee_id' => 'FSM ID',
            'hr_name' => 'FSM Name',
            'checklist_date' => 'Date',
            'in_time' => 'In Time',
            'out_time' => 'Out Time',
            'status' => 'Status',
        ];
    }
}
