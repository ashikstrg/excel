<?php

namespace backend\models;

use Yii;

class TrainingAssessmentAnswer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'training_assessment_answer';
    }

    public function rules()
    {
        return [
            [['category_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'question_name', 'answer'], 'required'],
            [['category_id'], 'integer'],
            [['question_name', 'remark'], 'string'],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name'], 'string', 'max' => 80],
            [['hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['answer'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'hr_employee_id' => 'Employee ID',
            'hr_name' => 'Name',
            'hr_designation' => 'Hr Designation',
            'hr_employee_type' => 'Hr Employee Type',
            'question_name' => 'Question Name',
            'answer' => 'Answer',
            'remark' => 'Remark',
        ];
    }
}
