<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-view">

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
            'batch',
            'hr_id',
            'hr_employee_id',
            'hr_deignation',
            'hr_employee_type',
            'hr_name',
            'message',
            'training_datetime',
            'status',
            'read_status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
