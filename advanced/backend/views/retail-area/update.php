<?php

use yii\helpers\Html;

$this->title = 'Retail Area Update';
$this->miniTitle = 'Edit Retail Area';
$this->subTitle = '<b>Retail Area Form:</b> ' . $model->area;

$this->params['breadcrumbs'][] = ['label' => 'Retail Area Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-area-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
