<?php

use yii\helpers\Html;

$this->title = 'Channel Type Add';
$this->miniTitle = 'Create New Channel';
$this->subTitle = 'Channel Type Form';
$this->params['breadcrumbs'][] = ['label' => 'Channel Type Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="channel-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
