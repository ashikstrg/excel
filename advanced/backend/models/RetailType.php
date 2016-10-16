<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "retail_type".
 *
 * @property string $id
 * @property string $type
 * @property string $channel_type_id
 */
class RetailType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'channel_type_id'], 'required'],
            [['channel_type_id'], 'integer'],
            [['type'], 'string', 'max' => 100],
            [['channel_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChannelType::className(), 'targetAttribute' => ['channel_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Retail Type',
            'channel_type_id' => 'Channel Type',
        ];
    }

    public function getChannelType()
    {
        return $this->hasOne(ChannelType::className(), ['id' => 'channel_type_id']);
    }

}
