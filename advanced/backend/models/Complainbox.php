<?php

namespace backend\models;

use Yii;

class Complainbox extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'complainbox';
    }

    public function rules()
    {
        return [
            [['token_no', 'complain', 'hr_employee_id', 'hr_name', 'retail_dms_code', 'retail_name', 'complain_date'], 'required'],
            [['token_no'], 'integer'],
            [['complain', 'status', 'feedback'], 'string'],
            [['complain_date', 'feedback_date'], 'safe'],
            [['hr_employee_id', 'feedback_by_employee_id'], 'string', 'max' => 50],
            [['hr_name', 'feedback_by_name'], 'string', 'max' => 80],
            [['retail_dms_code'], 'string', 'max' => 100],
            [['retail_name'], 'string', 'max' => 150],
            [['token_no'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token_no' => 'Token No',
            'complain' => 'Complain',
            'hr_employee_id' => 'FSM Employee ID',
            'hr_name' => 'FSM Name',
            'retail_dms_code' => 'Retail Dms Code',
            'retail_name' => 'Retail Name',
            'status' => 'Status',
            'complain_date' => 'Complain Date',
            'feedback' => 'Feedback',
            'feedback_by_employee_id' => 'Feedback By Employee ID',
            'feedback_by_name' => 'Feedback By Name',
            'feedback_date' => 'Feedback Date',
        ];
    }
}
