<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Travel Application Preview';
$this->miniTitle = 'Travel Module';
$this->subTitle = $model->reason;
$this->params['breadcrumbs'][] = ['label' => 'Travel Application Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'batch',
            'reason',
            'start_date',
            'end_date',
            'place',
            'cost',
            'line_manager_employee_id',
            'line_manager_name',
            'status',
            'action_date',
            'action_by',
            'created_at',
        ],
    ]) ?>

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

</div>