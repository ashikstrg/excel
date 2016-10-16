<?php

use yii\helpers\Html;

$this->title = 'HR Update (Sales)';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Form (Sales)';

$this->params['breadcrumbs'][] = ['label' => 'HR Config (Sales)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-sales-update">

    <?= $this->render('_form', [
        'model' => $model,
        'hrDesignationModel' => $hrDesignationModel
    ]) ?>

</div>
