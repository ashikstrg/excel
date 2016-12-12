<?php

namespace backend\models;

use Yii;

class Stock extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'stock';
    }

    public function rules()
    {
        return [
            [['imei_no', 'product_model_code', 'product_color'], 'required'],
            [['batch', 'retail_id'], 'integer'],
            [['submission_date', 'created_at', 'updated_at', 'product_id', 'status'], 'safe'],
            [['retail_dms_code', 'retail_type', 'retail_channel_type'], 'string', 'max' => 100],
            [['retail_name', 'retail_zone'], 'string', 'max' => 150],
            [['retail_area', 'retail_territory'], 'string', 'max' => 250],
            [['product_name'], 'string', 'max' => 80],
            
            [['imei_no'], 'string', 'max' => 15],
            [['imei_no'], 'string', 'min' => 15, 'message' => 'IMEI Number must be 15 characters long.'],
            [['imei_no'], 'unique'],
            
            [['lifting_price', 'rrp'], 'number'],
            
            [['product_model_code', 'product_model_name', 'product_color', 'product_type'], 'string', 'max' => 50],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'retail_id' => 'Retail ID',
            'retail_dms_code' => 'Retail Dms Code',
            'retail_name' => 'Retail Name',
            'retail_type' => 'Retail Type',
            'retail_channel_type' => 'Retail Channel Type',
            'retail_zone' => 'Retail Zone',
            'retail_area' => 'Retail Area',
            'retail_territory' => 'Retail Territory',
            'product_name' => 'Product Name',
            'product_model_code' => 'Model Code',
            'product_model_name' => 'Model Name',
            'product_color' => 'Product Color',
            'product_type' => 'Product Type',
            'status' => 'Status',
            'product_id' => 'Product ID',
            'imei_no' => 'IMEI',
            'rrp' => 'RRP',
            'lifting_price' => 'Lifting Price',
            'submission_date' => 'Submission Date',
            'created_at' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
