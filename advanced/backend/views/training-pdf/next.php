<?php

use yii\helpers\Html;

$this->title = 'Training PDF Upload';
$this->miniTitle = 'Training Module';
$this->subTitle = 'PDF Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Training Configure', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-next">

    <?= $this->render('_form_next', [
        'model' => $model
    ]) ?>

</div>


