<?php

namespace backend\models;

class TrainingAssessmentCategory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'training_assessment_category';
    }

    public function rules()
    {
        return [
            [['name', 'message', 'designations', 'date_month', 'estimated_time', 'qlimit'], 'required'],
            [['batch', 'date_month', 'created_by', 'created_at', 'notification_count'], 'safe'],
            [['status'], 'string'],
            [['name', 'created_by'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 555]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'name' => 'Name',
            'designations' => 'Designations',
            'date_month' => 'Month',
            'status' => 'Status',
            'notification_count' => 'Notification',
            'created_at' => 'Created AT',
            'created_by' => 'Created BY',
            'estimated_time' => 'Estimated Time (Min)',
            'qlimit' => 'Total Question'
        ];
    }
}
