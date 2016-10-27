<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "training".
 *
 * @property string $id
 * @property string $batch
 * @property string $hr_id
 * @property string $hr_employee_id
 * @property string $hr_deignation
 * @property string $hr_employee_type
 * @property string $hr_name
 * @property string $message
 * @property string $training_datetime
 * @property string $status
 * @property string $read_status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Training extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'hr_id', 'hr_employee_id', 'hr_deignation', 'hr_employee_type', 'hr_name', 'message', 'training_datetime', 'created_by'], 'required'],
            [['batch', 'hr_id'], 'integer'],
            [['training_datetime', 'created_at', 'updated_at'], 'safe'],
            [['status', 'read_status'], 'string'],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_deignation', 'hr_employee_type'], 'string', 'max' => 100],
            [['hr_name'], 'string', 'max' => 80],
            [['message'], 'string', 'max' => 550],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
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
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Hr Employee ID',
            'hr_deignation' => 'Hr Deignation',
            'hr_employee_type' => 'Hr Employee Type',
            'hr_name' => 'Hr Name',
            'message' => 'Message',
            'training_datetime' => 'Training Datetime',
            'status' => 'Status',
            'read_status' => 'Read Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
