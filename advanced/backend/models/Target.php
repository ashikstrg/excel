<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "target".
 *
 * @property string $id
 * @property string $batch
 * @property string $retail_id
 * @property string $retail_dms_code
 * @property string $retail_name
 * @property string $retail_channel_type
 * @property string $retail_type
 * @property string $retail_zone
 * @property string $retail_area
 * @property string $retail_territory
 * @property string $hr_id
 * @property string $employee_id
 * @property string $employee_name
 * @property string $designation
 * @property string $fsm_vol
 * @property string $fsm_val
 * @property string $tm_parent
 * @property string $tm_employee_id
 * @property string $tm_name
 * @property string $tm_vol
 * @property string $tm_val
 * @property string $am_parent
 * @property string $am_employee_id
 * @property string $am_name
 * @property string $am_vol
 * @property string $am_val
 * @property string $csm_parent
 * @property string $csm_employee_id
 * @property string $csm_name
 * @property string $csm_vol
 * @property string $csm_val
 * @property string $product_name
 * @property string $product_model_code
 * @property string $product_model_name
 * @property string $product_type
 * @property string $target_date
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */

class Target extends \yii\db\ActiveRecord
{
    public $total_achv_percent;
    public $total_achv_percent_value;
    public $total;

    public static function tableName()
    {
        return 'target';
    }

    public function rules()
    {
        return [
            [['batch', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory', 'hr_id', 'employee_id', 'employee_name', 'designation', 'fsm_vol', 'fsm_val', 'tm_parent', 'tm_employee_id', 'tm_name', 'tm_vol', 'tm_val', 'am_parent', 'am_employee_id', 'am_name', 'am_vol', 'am_val', 'csm_parent', 'csm_employee_id', 'csm_name', 'csm_vol', 'csm_val', 'product_name', 'product_model_code', 'product_model_name', 'product_type', 'target_date', 'created_by'], 'required'],
            [['batch', 'retail_id', 'hr_id', 'fsm_vol', 'fsm_vol_sales', 'tm_parent', 'tm_vol', 'tm_vol_sales', 'am_parent', 'am_vol', 'am_vol_sales', 'csm_parent', 'csm_vol', 'csm_vol_sales'], 'integer'],
            [['fsm_val', 'fsm_val_sales', 'tm_val', 'tm_val_sales', 'am_val', 'am_val_sales', 'csm_val', 'csm_val_sales'], 'number'],
            [['target_date', 'created_at', 'updated_at'], 'safe'],
            [['retail_dms_code', 'retail_channel_type', 'retail_type', 'designation'], 'string', 'max' => 100],
            [['retail_name', 'retail_zone'], 'string', 'max' => 150],
            [['retail_area', 'retail_territory'], 'string', 'max' => 250],
            [['employee_id', 'tm_employee_id', 'am_employee_id', 'csm_employee_id', 'product_model_code', 'product_model_name', 'product_type'], 'string', 'max' => 50],
            [['employee_name', 'tm_name', 'am_name', 'csm_name', 'product_name'], 'string', 'max' => 80],
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
            'retail_channel_type' => 'Retail Channel Type',
            'retail_type' => 'Retail Type',
            'retail_zone' => 'Retail Zone',
            'retail_area' => 'Retail Area',
            'retail_territory' => 'Retail Territory',
            'hr_id' => 'Hr ID',
            'employee_id' => 'FSM ID',
            'employee_name' => 'FSM Name',
            'designation' => 'FSM Type',
            'fsm_vol' => 'FSM Volume',
            'fsm_val' => 'FSM Value',
            'tm_parent' => 'Tm Parent',
            'tm_employee_id' => 'Tm Employee ID',
            'tm_name' => 'TM Name',
            'tm_vol' => 'TM Volume',
            'tm_val' => 'TM Value',
            'am_parent' => 'Am Parent',
            'am_employee_id' => 'AM Employee ID',
            'am_name' => 'AM Name',
            'am_vol' => 'AM Volume',
            'am_val' => 'AM Value',
            'csm_parent' => 'Csm Parent',
            'csm_employee_id' => 'CSM Employee ID',
            'csm_name' => 'CSM Name',
            'csm_vol' => 'CSM Volume',
            'csm_val' => 'CSM Value',
            'product_name' => 'Product Name',
            'product_model_code' => 'Product Model Code',
            'product_model_name' => 'Product Model Name',
            'product_type' => 'Product Type',
            'target_date' => 'Target Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
