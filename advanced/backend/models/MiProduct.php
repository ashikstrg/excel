<?php

namespace backend\models;

class MiProduct extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'mi_product';
    }

    public function rules()
    {
        return [
            [['brand', 'model', 'display_size', 'display_type', 'generation', 'sim', 'weight', 'ram', 'rom', 'processor', 'battery', 'camera_rear', 'camera_front', 'special_feature', 'price', 'sale_out_vol', 'region', 'district', 'town', 'hr_id', 'hr_employee_id', 'hr_name', 'hr_designation', 'hr_employee_type', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'created_at'], 'required'],
            [['generation', 'sim'], 'string'],
            [['price'], 'number'],
            [['sale_out_vol', 'hr_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand', 'model', 'display_type', 'special_feature', 'region', 'district', 'town', 'hr_designation', 'hr_employee_type'], 'string', 'max' => 100],
            [['display_size', 'weight', 'ram', 'rom', 'battery'], 'string', 'max' => 10],
            [['processor', 'hr_employee_id', 'am_employee_id', 'csm_employee_id'], 'string', 'max' => 50],
            [['camera_rear', 'camera_front'], 'string', 'max' => 20],
            [['hr_name', 'am_name', 'csm_name'], 'string', 'max' => 80],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'display_size' => 'Display Size (inch)',
            'display_type' => 'Display Type',
            'generation' => 'Generation',
            'sim' => 'Sim',
            'weight' => 'Weight',
            'ram' => 'RAM',
            'rom' => 'ROM',
            'processor' => 'Processor',
            'battery' => 'Battery (maH)',
            'camera_rear' => 'Camera Rear',
            'camera_front' => 'Camera Front',
            'special_feature' => 'Special Feature',
            'price' => 'Price',
            'sale_out_vol' => 'Sale Out Vol',
            'region' => 'Region',
            'district' => 'District',
            'town' => 'Town',
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
