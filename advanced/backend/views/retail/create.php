<?php

use yii\helpers\Html;

$this->title = 'Retail Add';
$this->miniTitle = 'Create New Retail';
$this->subTitle = 'Retail Form';

$this->params['breadcrumbs'][] = ['label' => 'Retail Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-create">

    <?= $this->render('_form', [
        'model' => $model,
        'channelTypeModel' => $channelTypeModel,
        'retailZoneModel' => $retailZoneModel,
        'retailAreaModel' => $retailAreaModel,
        'retailLocationModel' => $retailLocationModel,
        'divisionsModel' => $divisionsModel
    ]) ?>

</div>
