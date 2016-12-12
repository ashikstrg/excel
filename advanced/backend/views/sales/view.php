<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Sales Detail';
$this->miniTitle = 'Sales Module';
$this->subTitle = '<b>IMEI No:</b> ' . $model->imei_no;

$this->params['breadcrumbs'][] = ['label' => 'Sales Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="sales-view">

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
            'tm_employee_id',
            'tm_name',
            'am_employee_id',
            'am_name',
            'csm_employee_id',
            'csm_name',
            'product_name',
            'product_model_code',
            'product_model_name',
            'product_color',
            'product_type',
            'imei_no',
            'price',
            'sales_date',
            'created_at',
            'created_by',
        ],
    ]) ?>
    
    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Add New Sales', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('View Raw Data', ['index'], ['class' => 'btn btn-primary']) ?>
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
