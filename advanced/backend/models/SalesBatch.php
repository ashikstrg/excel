<?php

namespace backend\models;

use Yii;

class SalesBatch extends \yii\db\ActiveRecord
{
    public $file;
    
    public static function tableName()
    {
        return 'sales_batch';
    }

    public function rules()
    {
        return [
            [['batch', 'file_import'], 'required'],
            [['batch'], 'integer'],
            [['created_at', 'deleted_at'], 'safe'],
            [['file_import', 'created_by', 'deleted_by'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'file_import' => 'File Import',
            'status' => 'Status',
            'created_by' => 'Created By',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
