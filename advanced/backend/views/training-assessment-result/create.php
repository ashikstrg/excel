<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentResult */

$this->title = 'Create Training Assessment Result';
$this->params['breadcrumbs'][] = ['label' => 'Training Assessment Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
