<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property string $id
 * @property string $name
 * @property string $module_name
 * @property string $url
 * @property string $hr_id
 * @property string $hr_employee_id
 * @property string $hr_designation
 * @property string $hr_employee_type
 * @property string $hr_name
 * @property string $message
 * @property string $read_status
 * @property string $seen
 * @property string $created_at
 * @property string $created_by
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'module_name', 'url', 'hr_id', 'hr_employee_id', 'hr_designation', 'hr_employee_type', 'hr_name', 'message', 'created_by'], 'required'],
            [['hr_id'], 'integer'],
            [['read_status'], 'string'],
            [['seen', 'created_at'], 'safe'],
            [['name', 'url', 'created_by'], 'string', 'max' => 255],
            [['module_name', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['hr_employee_id'], 'string', 'max' => 50],
            [['hr_name'], 'string', 'max' => 80],
            [['message'], 'string', 'max' => 550],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'module_name' => 'Module Name',
            'url' => 'Url',
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Hr Employee ID',
            'hr_designation' => 'Hr Designation',
            'hr_employee_type' => 'Hr Employee Type',
            'hr_name' => 'Hr Name',
            'message' => 'Message',
            'read_status' => 'Read Status',
            'seen' => 'Seen',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
