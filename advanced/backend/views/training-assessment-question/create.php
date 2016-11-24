<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentQuestion */

$this->title = 'Create Training Assessment Question';
$this->params['breadcrumbs'][] = ['label' => 'Training Assessment Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
