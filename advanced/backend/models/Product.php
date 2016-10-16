<?php

namespace backend\models;

use Yii;

class Product extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'model_code', 'model_name', 'color', 'type', 'lifting_price', 'rrp', 'status'], 'required'],
            [['lifting_price', 'rrp'], 'number'],
            [['name'], 'string', 'max' => 80],
            [['model_code', 'model_name', 'color', 'type'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 10],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            // Custom
            [['model_code'], 'unique', 'targetAttribute' => ['model_code', 'color']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'model_code' => 'Model Code',
            'model_name' => 'Model Name',
            'color' => 'Product Color',
            'type' => 'Product Type',
            'lifting_price' => 'Lifting Price',
            'rrp' => 'RRP',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By'
        ];
    }
}
