<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingBatch */

$this->title = 'Create Training Batch';
$this->params['breadcrumbs'][] = ['label' => 'Training Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-batch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
