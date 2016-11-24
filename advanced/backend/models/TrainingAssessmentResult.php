<?php

namespace backend\models;

use Yii;

class TrainingAssessmentResult extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'training_assessment_result';
    }

    public function rules()
    {
        return [
            [['category_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'score', 'score_percent', 'total_time', 'date_month', 'participation_datetime', 'right_answer', 'wrong_answer', 'un_answer'], 'required'],
            [['category_id', 'score', 'right_answer', 'wrong_answer', 'un_answer'], 'integer'],
            [['score_percent', 'total_time'], 'number'],
            [['date_month', 'participation_datetime'], 'safe'],
            [['status'], 'string'],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name'], 'string', 'max' => 80],
            [['hr_designation', 'hr_employee_type'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'hr_employee_id' => 'Employee ID',
            'hr_name' => 'Name',
            'hr_designation' => 'Designation',
            'hr_employee_type' => 'Employee Type',
            'score' => 'Score',
            'score_percent' => 'Score Percent',
            'total_time' => 'Total Time (Min)',
            'date_month' => 'Date',
            'participation_datetime' => 'Participation Datetime',
            'status' => 'Status',
            'right_answer' => 'Right',
            'wrong_answer' => 'Wrong',
            'un_answer' => 'Unanswered'
        ];
    }
}
