<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property string $id
 * @property string $batch
 * @property string $retail_id
 * @property string $retail_dms_code
 * @property string $retail_name
 * @property string $retail_type
 * @property string $retail_channel_type
 * @property string $retail_zone
 * @property string $retail_area
 * @property string $retail_territory
 * @property string $product_id
 * @property string $product_name
 * @property string $product_model_code
 * @property string $product_model_name
 * @property string $product_color
 * @property string $product_type
 * @property integer $status
 * @property string $volume
 * @property string $submission_date
 * @property string $cretated_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory', 'product_id', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'volume', 'submission_date', 'created_by'], 'required'],
            [['batch', 'retail_id', 'product_id', 'status', 'volume'], 'integer'],
            [['submission_date', 'cretated_at', 'updated_at'], 'safe'],
            [['retail_dms_code', 'retail_type', 'retail_channel_type'], 'string', 'max' => 100],
            [['retail_name', 'retail_zone'], 'string', 'max' => 150],
            [['retail_area', 'retail_territory'], 'string', 'max' => 250],
            [['product_name'], 'string', 'max' => 80],
            [['product_model_code', 'product_model_name', 'product_color', 'product_type'], 'string', 'max' => 50],
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
            'retail_id' => 'Retail ID',
            'retail_dms_code' => 'Retail Dms Code',
            'retail_name' => 'Retail Name',
            'retail_type' => 'Retail Type',
            'retail_channel_type' => 'Retail Channel Type',
            'retail_zone' => 'Retail Zone',
            'retail_area' => 'Retail Area',
            'retail_territory' => 'Retail Territory',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'product_model_code' => 'Model Code',
            'product_model_name' => 'Model Name',
            'product_color' => 'Product Color',
            'product_type' => 'Product Type',
            'status' => 'Status',
            'volume' => 'Amount',
            'submission_date' => 'Submission Date',
            'cretated_at' => 'Cretated At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
