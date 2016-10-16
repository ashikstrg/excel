<?php

namespace backend\models;

use Yii;


class HrEmployeeType extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'hr_employee_type';
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type'
        ];
    }

}
