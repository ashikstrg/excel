<?php

use yii\helpers\Html;

$this->title = 'Target Data Upload';
$this->miniTitle = 'Target Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Target Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
