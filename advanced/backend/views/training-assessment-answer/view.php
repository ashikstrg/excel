<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentAnswer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Training Assessment Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'hr_employee_id',
            'hr_name',
            'hr_designation',
            'hr_employee_type',
            'question_name:ntext',
            'answer',
            'remark',
        ],
    ]) ?>

</div>
