<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "divisions".
 *
 * @property string $id
 * @property string $name
 *
 * @property Districts[] $districts
 */
class Divisions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'divisions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(Districts::className(), ['division_id' => 'id']);
    }
}
