<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hr */

$this->title = 'Update Hr: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'hrDesignationModel' => $hrDesignationModel,
        'retailModel' => $retailModel
    ]) ?>

</div>
