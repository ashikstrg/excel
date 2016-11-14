<?php

use yii\helpers\Html;

$this->title = 'Add Training PDF';
$this->miniTitle = 'Training Module';
$this->subTitle = 'Training PDF Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Training PDF Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-create">

    <?= $this->render('_form', [
        'model' => $model,
        'designationModel' => $designationModel
    ]) ?>

</div>