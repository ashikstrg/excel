<?php

namespace backend\models;

use Yii;

class Retail extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'retail';
    }

    public function rules()
    {
        return [
            [['channel_type', 'retail_type', 'dms_code', 'name', 'retail_zone', 'retail_area', 'territory', 'retail_location', 'division', 'district', 'upazila', 'market_name', 'geotag', 'Address', 'contact_no', 'owner_name', 'owner_contact_no', 'owner_email', 'store_contact_no', 'store_email', 'manager_name', 'manager_contact_no', 'store_size_sft', 'store_facade_feet', 'number_sec', 'number_rsa', 'day_off'], 'required'],
            [['status', 'connectivity_wifi'], 'string'],
            [['store_size_sft', 'store_facade_feet', 'number_sec', 'number_rsa'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['channel_type', 'retail_type', 'dms_code', 'geotag'], 'string', 'max' => 100],
            [['name', 'retail_zone'], 'string', 'max' => 150],
            [['retail_area', 'territory', 'retail_location', 'market_name'], 'string', 'max' => 250],
            [['division', 'district', 'upazila'], 'string', 'max' => 30],
            [['Address'], 'string', 'max' => 550],
            
            [['day_off'], 'string', 'max' => 20],
            [['contact_no', 'owner_contact_no', 'manager_contact_no'], 'string', 'max' => 11],
            [['store_contact_no'], 'string', 'min' => 9],
            [['contact_no', 'owner_contact_no', 'manager_contact_no'], 'match', 'pattern' => '/^(01)(1|5|6|7|8|9)\d{8}$/'],
            
            [['owner_name', 'manager_name'], 'string', 'max' => 60],
            [['owner_email', 'store_email'], 'string', 'max' => 80],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            //Custom
            [['channelType', 'retailType', 'retailZone', 'retailArea', 'retailLocation', 'divisionProperty', 'districtProperty', 'upazilaProperty'], 'required'],
            [['channelType', 'retailType', 'retailZone', 'retailArea', 'retailLocation', 'divisionProperty', 'districtProperty', 'upazilaProperty'], 'integer'],
            [['owner_email', 'store_email'], 'email'],
            [['dms_code'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel_type' => 'Channel Type',
            'channelType' => 'Channel Type',
            'retail_type' => 'Retail Type',
            'retailType' => 'Retail Type',
            'status' => 'Status',
            'dms_code' => 'DMS Code',
            'name' => 'Retail Name',
            'retail_zone' => 'Retail Zone',
            'retailZone' => 'Retail Zone',
            'retail_area' => 'Retail Area',
            'retailArea' => 'Retail Area',
            'territory' => 'Territory',
            'retail_location' => 'Retail Location',
            'retailLocation' => 'Retail Location',
            'division' => 'Division',
            'divisionProperty' => 'Division',
            'district' => 'District',
            'districtProperty' => 'District',
            'upazila' => 'Upazila/Thana',
            'upazilaProperty' => 'Upazila/Thana',
            'market_name' => 'Market Name',
            'geotag' => 'Geotag',
            'Address' => 'Address',
            'contact_no' => 'Contact No',
            'owner_name' => 'Owner Name',
            'owner_contact_no' => 'Owner Contact No',
            'owner_email' => 'Owner Email Address',
            'store_contact_no' => 'Store Contact No',
            'store_email' => 'Store Email Address',
            'manager_name' => 'Manager Name',
            'manager_contact_no' => 'Manager Contact No',
            'store_size_sft' => 'Store Size (Sft)',
            'store_facade_feet' => 'Store Facade (Feet)',
            'number_sec' => 'Number of SEC',
            'number_rsa' => 'Number of RSA',
            'day_off' => 'Day Off',
            'connectivity_wifi' => 'Connectivity (Wifi)',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
