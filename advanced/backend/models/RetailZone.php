<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "retail_zone".
 *
 * @property string $id
 * @property string $zone
 */
class RetailZone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone'], 'required'],
            [['zone'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zone' => 'Zone',
        ];
    }
}
