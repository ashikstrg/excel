<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "left_menu".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $label
 * @property string $icon
 * @property string $url
 * @property string $used_by
 */
class LeftMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'left_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'label', 'icon', 'used_by', 'name'], 'required'],
            [['parent_id'], 'integer'],
            [['label', 'icon', 'url', 'name'], 'string', 'max' => 255],
            [['used_by'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'label' => 'Label',
            'icon' => 'Icon',
            'url' => 'Url',
            'used_by' => 'Used By',
            'name' => 'Name'
        ];
    }
}
