<?php

namespace backend\models;

use Yii;

class TrainingPdf extends \yii\db\ActiveRecord
{

    public $file;
    
    public static function tableName()
    {
        return 'training_pdf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'name', 'file_import'], 'required'],
            [['batch', 'notification_count'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'deleted_at', 'training_datetime'], 'safe'],
            [['name', 'file_import', 'created_by', 'deleted_by'], 'string', 'max' => 255],
            [['training_datetime'], 'string', 'max' => 50],
            [['batch'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'name' => 'Name',
            'file_import' => 'File Import',
            'status' => 'Status',
            'notification_count' => 'Notification Count',
            'created_by' => 'Created By',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
            'training_datetime' => 'Training Datetime',
        ];
    }
}
