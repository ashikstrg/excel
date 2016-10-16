<?php

namespace backend\models;

use Yii;

class ProductColor extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product_color';
    }

    public function rules()
    {
        return [
            [['color'], 'required'],
            [['color'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Product Color',
        ];
    }
}
