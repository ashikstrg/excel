<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Upazilas */

$this->title = 'Update Upazilas: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Upazilas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="upazilas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
