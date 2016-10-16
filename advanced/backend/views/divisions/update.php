<?php

use yii\helpers\Html;

$this->title = 'Division Update';
$this->miniTitle = 'Update New Division';
$this->subTitle = '<b>Division Form:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Division Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
