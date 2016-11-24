<?php

namespace backend\models;

class TrainingAssessmentQuestion extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'training_assessment_question';
    }

    public function rules()
    {
        return [
            [['question_name', 'answer1', 'answer2', 'answer3', 'answer4', 'answer', 'category_id', 'choice'], 'required'],
            [['question_name', 'choice'], 'string'],
            [['answer', 'category_id'], 'integer'],
            [['answer1', 'answer2', 'answer3', 'answer4'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_name' => 'Question Name',
            'answer1' => 'Answer1',
            'answer2' => 'Answer2',
            'answer3' => 'Answer3',
            'answer4' => 'Answer4',
            'answer' => 'Answer',
            'choice' => 'Choice',
            'category_id' => 'Category ID',
        ];
    }
}
