<?php

namespace backend\models;

use Yii;

class TrainingBatch extends \yii\db\ActiveRecord
{
    public $file;
    public $message;

    public static function tableName()
    {
        return 'training_batch';
    }

    public function rules()
    {
        return [
            [['batch', 'name', 'file_import', 'message'], 'required'],
            [['batch'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'deleted_at'], 'safe'],
            [['name', 'file_import', 'created_by', 'deleted_by'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 550],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'name' => 'Name',
            'file_import' => 'File Import',
            'status' => 'Status',
            'created_by' => 'Created By',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
