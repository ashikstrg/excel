<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Target Detail';
$this->miniTitle = 'Target Module';
$this->subTitle = '<b>Batch No:</b> ' . $model->batch;

$this->params['breadcrumbs'][] = ['label' => 'Target Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="target-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'retail_dms_code',
            'retail_name',
            'retail_channel_type',
            'retail_type',
            'retail_zone',
            'retail_area',
            'retail_territory',
            'employee_id',
            'employee_name',
            'designation',
            'fsm_vol',
            'fsm_val',
            'tm_employee_id',
            'tm_name',
            'tm_vol',
            'tm_val',
            'am_employee_id',
            'am_name',
            'am_vol',
            'am_val',
            'csm_employee_id',
            'csm_name',
            'csm_vol',
            'csm_val',
            'product_name',
            'product_model_code',
            'product_model_name',
            'product_type',
            'target_date',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Upload Target Data', ['target-batch/create'], ['class' => 'btn btn-success']) ?>
            
        </div>
        <div class="col-md-6">
            <div class="pull-right">
            <?= Html::a('Raw Target Data', ['index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>