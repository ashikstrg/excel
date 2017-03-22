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
            [['brand', 'model', 'posm', 'retail_type', 'store_size', 'owner', 'distributor_type', 'sales_team', 'rsa', 'fsm_type', 'region', 'district', 'town', 'hr_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at'], 'required'],
            [['retail_type', 'owner', 'distributor_type', 'fsm_type'], 'string'],
            [['hr_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand', 'model', 'region', 'district', 'town', 'posm', 'image', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['store_size'], 'string', 'max' => 10],
            [['sales_team', 'rsa', 'hr_employee_id', 'am_employee_id', 'csm_employee_id'], 'string', 'max' => 50],
            [['hr_name', 'am_name', 'csm_name'], 'string', 'max' => 80],
            
            [['image_src_filename', 'image_web_filename', 'image_web_filename'], 'string', 'max' => 255],

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
            'retail_type' => 'Retail Type',
            'store_size' => 'Store Size',
            'owner' => 'Owner',
            'distributor_type' => 'Distributor Type',
            'sales_team' => 'Sales Team',
            'rsa' => 'RSA',
            'fsm_type' => 'FSM Type',
            'region' => 'Region',
            'district' => 'District',
            'town' => 'Town',
            'hr_id' => 'Hr ID',
            'hr_employee_id' => 'Employee ID',
            'hr_name' => 'Name',
            'hr_designation' => 'Designation',
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
