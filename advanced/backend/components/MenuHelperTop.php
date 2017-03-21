<?php 

namespace backend\components;
use backend\models\TopMenu;

class MenuHelperTop
{

    public static function getMenu()
    {
        $role_id = 0;
        $result = static::getMenuRecrusive($role_id);
        return $result;
    }

    private static function getMenuRecrusive($parent)
    {
        $userRole = \Yii::$app->session->get('userRole');

        $items = TopMenu::find()
            ->where(['parent_id' => $parent, 'used_by' => $userRole])
            ->orderBy('id')
            ->asArray()
            ->all();

        $result = []; 

        foreach ($items as $item) {
            $result[] = [
                    'label' => $item['label'],
                    'url' => [$item['url']],
                    'icon' => $item['icon'],
                    'items' => static::getMenuRecrusive($item['id']),
                ];
        }
        
        return $result;
    }

}

