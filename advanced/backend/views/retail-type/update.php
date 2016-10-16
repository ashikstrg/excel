<?php

use yii\helpers\Html;

$this->title = 'Retail Type Update';
$this->miniTitle = 'Edit Retail Type';
$this->subTitle = 'Retail Type Form: ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Retail Type Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="retail-type-update">

    <?= $this->render('_form', [
        'model' => $model,
        'channelTypeModel' => $channelTypeModel
    ]) ?>

</div>
