<?php

use yii\helpers\Html;

$this->title = 'Channel Type Update';
$this->miniTitle = 'Edit Channel';
$this->subTitle = 'Channel Type Form - ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Channel Type Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="channel-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
