<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property string $id
 * @property string $division_id
 * @property string $name
 *
 * @property Divisions $division
 * @property Upazilas[] $upazilas
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division_id', 'name'], 'required'],
            [['division_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => Divisions::className(), 'targetAttribute' => ['division_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'division_id' => 'Division',
            'name' => 'District',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Divisions::className(), ['id' => 'division_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpazilas()
    {
        return $this->hasMany(Upazilas::className(), ['district_id' => 'id']);
    }
}
