<?php

namespace backend\models;

use Yii;

class HrDesignation extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'hr_designation';
    }

    public function rules()
    {
        return [
            [['type', 'parent'], 'required'],
            [['id', 'employee_type_id', 'parent'], 'integer'],
            [['type', 'employee_type', 'parent_name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Designation',
            'employee_type_id' => 'Employee Type',
            'employee_type' => 'Employee Type',
            'parent' => 'Hierarchy',
            'parent_name' => 'Hierarchy'
        ];
    }
}
