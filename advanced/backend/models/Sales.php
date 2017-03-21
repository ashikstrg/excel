<?php

namespace backend\models;

use Yii;

class Sales extends \yii\db\ActiveRecord
{
    public $D01;
    public $D02;
    public $D03;
    public $D04;
    public $D05;
    public $D06;
    public $D07;
    public $D08;
    public $D09;
    public $D10;
    public $D11;
    public $D12;
    public $D13;
    public $D14;
    public $D15;
    public $D16;
    public $D17;
    public $D18;
    public $D19;
    public $D20;
    public $D21;
    public $D22;
    public $D23;
    public $D24;
    public $D25;
    public $D26;
    public $D27;
    public $D28;
    public $D29;
    public $D30;
    public $D31;
    public $total_national;
    public $date_range;
    public $total;
    
    public static function tableName()
    {
        return 'sales';
    }

    public function rules()
    {
        return [
            [['imei_no'], 'required'],
            [['batch', 'retail_id', 'tm_parent', 'am_parent', 'csm_parent', 'product_id', 'hr_id'], 'integer'],
            [['price', 'lifting_price'], 'number'],
            [['sales_date', 'created_at'], 'safe'],
            [['retail_dms_code', 'retail_channel_type', 'retail_type', 'designation'], 'string', 'max' => 100],
            [['retail_name', 'retail_zone'], 'string', 'max' => 150],
            [['retail_area', 'retail_territory'], 'string', 'max' => 250],
            [['employee_id', 'tm_employee_id', 'am_employee_id', 'csm_employee_id', 'product_model_code', 'product_model_name', 'product_color', 'product_type'], 'string', 'max' => 50],
            [['employee_name', 'tm_name', 'am_name', 'csm_name', 'product_name'], 'string', 'max' => 80],
            
            [['imei_no'], 'string', 'max' => 15, 'message' => '{attribute} must be 15 characters long.'],
            [['imei_no'], 'string', 'min' => 15, 'message' => '{attribute} must be 15 characters long.'],
            [['imei_no'], 'unique'],
            
            [['status'], 'safe'],
            
            [['created_by'], 'string', 'max' => 255],    
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'retail_id' => 'Retail ID',
            'retail_dms_code' => 'Retail Dms Code',
            'retail_name' => 'Retail Name',
            'retail_channel_type' => 'Channel Type',
            'retail_type' => 'Retail Type',
            'retail_zone' => 'Zone',
            'retail_area' => 'Area',
            'retail_territory' => 'Territory',
            'hr_id' => 'FSM',
            'designation' => 'FSM Type',
            'employee_id' => 'FSM ID',
            'employee_name' => 'FSM Name',
            'tm_parent' => 'TM Parent',
            'tm_employee_id' => 'TM ID',
            'tm_name' => 'TM Name',
            'am_parent' => 'AM Parent',
            'am_employee_id' => 'AM ID',
            'am_name' => 'AM Name',
            'csm_parent' => 'Csm Parent',
            'csm_employee_id' => 'CSM ID',
            'csm_name' => 'CSM Name',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'product_model_code' => 'Model Code',
            'product_model_name' => 'Model Name',
            'product_color' => 'Color',
            'product_type' => 'Product Type',
            'imei_no' => 'IMEI',
            'price' => 'Price',
            'lifting_price' => 'Lifting Price',
            'sales_date' => 'Sales Date',
            'created_at' => 'Upload Date',
            'created_by' => 'Created By',
            'total_national' => 'Total',
            'D01' => '01',
            'D02' => '02',
            'D03' => '03',
            'D04' => '04',
            'D05' => '05',
            'D06' => '06',
            'D07' => '07',
            'D08' => '08',
            'D09' => '09',
            'D10' => '10',
            'D11' => '11',
            'D12' => '12',
            'D13' => '13',
            'D14' => '14',
            'D15' => '15',
            'D16' => '16',
            'D17' => '17',
            'D18' => '18',
            'D19' => '19',
            'D20' => '20',
            'D21' => '21',
            'D22' => '22',
            'D23' => '23',
            'D24' => '24',
            'D25' => '25',
            'D26' => '26',
            'D27' => '27',
            'D28' => '28',
            'D29' => '29',
            'D30' => '30',
            'D31' => '31'
        ];
    }
    
}
