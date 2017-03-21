<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "top_menu".
 *
 * @property string $id
 * @property string $name
 * @property string $parent_id
 * @property string $label
 * @property string $icon
 * @property string $url
 * @property string $used_by
 */
class TopMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'top_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id', 'label', 'icon', 'used_by'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'label', 'icon', 'url'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'label' => 'Label',
            'icon' => 'Icon',
            'url' => 'Url',
            'used_by' => 'Used By',
        ];
    }
}
