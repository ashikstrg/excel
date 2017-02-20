<?php

namespace backend\models;

use Yii;

class HrBatch extends \yii\db\ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return 'hr_batch';
    }

    public function rules()
    {
        return [
            [['batch'], 'required'],
            [['batch', 'total_row'], 'integer'],
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
            'total_row' => 'Total Row',
            'file_import' => 'File Import',
            'status' => 'Status',
            'created_by' => 'Created By',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
