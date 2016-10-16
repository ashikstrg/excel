<?php

namespace backend\models;

use Yii;

class ProductType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'product_type';
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Product Type / Segment',
        ];
    }
}
