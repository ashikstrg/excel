<?php

use yii\helpers\Html;

$this->title = 'Retail Type Add';
$this->miniTitle = 'Create New Retail Type';
$this->subTitle = 'Retail Type Form';
$this->params['breadcrumbs'][] = ['label' => 'Retail Type Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="retail-type-create">

    <?= $this->render('_form', [
        'model' => $model,
        'channelTypeModel' => $channelTypeModel
    ]) ?>

</div>
