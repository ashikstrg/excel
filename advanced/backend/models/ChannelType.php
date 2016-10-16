<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "channel_type".
 *
 * @property string $id
 * @property string $type
 */
class ChannelType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_channel_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Channel Type',
        ];
    }
}
