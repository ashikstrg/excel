<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "training_batch".
 *
 * @property string $id
 * @property string $batch
 * @property string $name
 * @property string $file_import
 * @property string $status
 * @property integer $notification_count
 * @property string $created_by
 * @property string $deleted_by
 * @property string $created_at
 * @property string $deleted_at
 * @property string $training_datetime
 */
class TrainingBatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_batch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'name', 'file_import', 'training_datetime'], 'required'],
            [['batch', 'notification_count'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'deleted_at', 'training_datetime'], 'safe'],
            [['name', 'file_import', 'created_by', 'deleted_by'], 'string', 'max' => 255],
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
