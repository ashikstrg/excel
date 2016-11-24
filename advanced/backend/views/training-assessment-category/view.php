<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Assessment Detail';
$this->miniTitle = 'Assessment Module';
$this->subTitle = '<b>Assessment Name:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Assessment Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="training-assessment-category-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'message',
            'designations',
            'qlimit',
            'estimated_time',
            'date_month',
            'status',
            'notification_count',
            'created_at',
            'created_by'
        ],
    ]) ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Add New', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Configure', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]); ?>
            </div>
        </div>
    </div>
</div>