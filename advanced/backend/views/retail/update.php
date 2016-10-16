<?php

use yii\helpers\Html;

$this->title = 'Retail Update';
$this->miniTitle = 'Edit Retail';
$this->subTitle = '<b>Retail Form:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Retail Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-update">

    <?= $this->render('_form', [
        'model' => $model,
        'channelTypeModel' => $channelTypeModel,
        'retailZoneModel' => $retailZoneModel,
        'retailAreaModel' => $retailAreaModel,
        'retailLocationModel' => $retailLocationModel,
        'divisionsModel' => $divisionsModel
    ]); ?>

</div>
