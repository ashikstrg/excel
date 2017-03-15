<?php

namespace backend\models;

use Yii;

class Inventory extends \yii\db\ActiveRecord
{    
    public static $validityIn = 'in';
    public static $validityOut = 'out';
    
    public static $stageInventory = 'inventory';
    public static $stageStock = 'stock';
    public static $stageSold = 'sold';
    
    public $from_row;
    public $total_row;
    
    public static function tableName()
    {
        return 'inventory';
    }

    public function rules()
    {
        return [
            [['imei_no', 'product_model_code', 'product_color'], 'required'],
            [['batch', 'product_id'], 'integer'],
            [['lifting_price', 'rrp'], 'number'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            
            [['imei_no'], 'string', 'max' => 15],
            
            [['stage'], 'in', 'range'=> ['inventory', 'stock', 'sold']],
            [['validity'], 'in', 'range'=> ['in', 'out']],
            
            [['product_name'], 'string', 'max' => 80],
            [['product_model_code', 'product_model_name', 'product_color', 'product_type'], 'string', 'max' => 50],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            [['imei_no'], 'unique'],
            [['batch'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch' => 'Batch',
            'imei_no' => 'Imei No',
            'product_name' => 'Product Name',
            'product_model_code' => 'Product Model Code',
            'product_model_name' => 'Product Model Name',
            'product_color' => 'Product Color',
            'product_type' => 'Product Type',
            'lifting_price' => 'Lifting Price',
            'rrp' => 'RRP',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
