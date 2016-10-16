<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "retail_location".
 *
 * @property string $id
 * @property string $location
 */
class RetailLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location'], 'required'],
            [['location'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
        ];
    }
}
