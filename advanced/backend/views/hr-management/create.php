<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\HrManagement */

$this->title = 'Create Hr Management';
$this->params['breadcrumbs'][] = ['label' => 'Hr Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-management-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
