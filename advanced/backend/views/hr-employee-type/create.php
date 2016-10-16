<?php

use yii\helpers\Html;

$this->title = 'Employee Type Add';
$this->miniTitle = 'HR Module';
$this->subTitle = 'Employee Type Form';

$this->params['breadcrumbs'][] = ['label' => 'Employee Type Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-employee-type-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>