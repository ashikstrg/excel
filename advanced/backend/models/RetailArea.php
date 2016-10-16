<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "retail_area".
 *
 * @property string $id
 * @property string $area
 */
class RetailArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area'], 'required'],
            [['area'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
        ];
    }
}
