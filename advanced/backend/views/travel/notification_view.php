<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Travel Application';
$this->miniTitle = 'Travel Module';
$this->subTitle = '<b>From: </b>' . $model->hr_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hr_name',
            'hr_employee_id',
            'hr_designation',
            'reason',
            'start_date',
            'end_date',
            'place',
            'cost',
            'created_at',
            'status'
        ],
    ]) ?>
    
    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::a('Reject', ['reject', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>

</div>