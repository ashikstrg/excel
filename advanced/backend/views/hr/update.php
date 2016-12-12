<?php

use yii\helpers\Html;

$this->title = 'Update HR';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Form: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'HR Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-update">

    <?= $this->render('_form', [
        'model' => $model,
        'hrDesignationModel' => $hrDesignationModel, 
        'retailModel' => $retailModel
    ]) ?>

</div>
