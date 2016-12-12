<?php

namespace backend\models;

use Yii;

class MiVisibility extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mi_visibility';
    }

    public function rules()
    {
        return [
            [['brand', 'model', 'posm', 'hr_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at'], 'required'],
            [['hr_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand', 'model', 'posm', 'image', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['image_src_filename', 'image_web_filename', 'image_web_filename'], 'string', 'max' => 255],
            [['hr_employee_id', 'am_employee_id', 'csm_employee_id'], 'string', 'max' => 50],
            [['hr_name', 'am_name', 'csm_name'], 'string', 'max' => 80],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'posm' => 'POSM',
            'image' => 'Image',
            'image_src_filename' => 'Image Src Filename',
            'image_web_filename' => 'Image Web Filename',
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Hr Employee ID',
            'hr_name' => 'Hr Name',
            'hr_designation' => 'Hr Designation',
            'hr_employee_type' => 'Hr Employee Type',
            'am_employee_id' => 'Am Employee ID',
            'am_name' => 'Am Name',
            'csm_employee_id' => 'Csm Employee ID',
            'csm_name' => 'Csm Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
