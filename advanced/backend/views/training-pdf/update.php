<?php

use yii\helpers\Html;

$this->title = 'Training Data Update';
$this->miniTitle = 'Training Module';
$this->subTitle = '<b>Training Form:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Training Configure', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-update">

    <?= $this->render('_form', [
        'model' => $model,
        'designationModel' => $designationModel
    ]) ?>

</div>
