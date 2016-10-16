<?php

use yii\helpers\Html;

$this->title = 'Add Signup Info';
$this->subTitle = 'User Form';
$this->miniTitle = 'Add User Info';
$this->params['breadcrumbs'][] = ['label' => 'User List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
        'model' => $model,
        'userRoleModel' => $userRoleModel
    ]);

