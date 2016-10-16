<?php

use yii\helpers\Html;

$this->title = 'Employee Type Update';
$this->miniTitle = 'HR Module';
$this->subTitle = '<b>Employee Type Form:</b> ' . $model->type;

$this->params['breadcrumbs'][] = ['label' => 'Employee Type Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-employee-type-update">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>