<?php

namespace backend\models;

use Yii;

class TargetBatch extends \yii\db\ActiveRecord
{
    
    public $file;
    
    public static function tableName()
    {
        return 'target_batch';
    }

    public function rules()
    {
        return [
            [['batch', 'file_import', 'target_date'], 'required'],
            [['batch'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'deleted_at'], 'safe'],
            [['file_import', 'created_by', 'deleted_by'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'file_import' => 'File Import',
            'status' => 'Status',
            'created_by' => 'Uploaded By',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Uploaded At',
            'deleted_at' => 'Deleted At',
            'target_date' => 'Month'
        ];
    }
}
