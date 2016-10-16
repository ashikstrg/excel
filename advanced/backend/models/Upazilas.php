<?php

namespace backend\models;

use Yii;

class Upazilas extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'upazilas';
    }

    public function rules()
    {
        return [
            [['district_id', 'name'], 'required'],
            [['district_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'District',
            'division_id' => 'Division',
            'name' => 'Upazila',
        ];
    }

    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id'])->with(['division']);
    }

}
