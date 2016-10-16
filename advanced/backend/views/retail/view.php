<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Retail Detail';
$this->miniTitle = 'View Retail';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Retail Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'channel_type',
            'retail_type',
            'status',
            'dms_code',
            'name',
            'retail_zone',
            'retail_area',
            'territory',
            'retail_location',
            'division',
            'district',
            'upazila',
            'market_name',
            'geotag',
            'Address',
            'contact_no',
            'owner_name',
            'owner_contact_no',
            'owner_email:email',
            'store_contact_no',
            'store_email:email',
            'manager_name',
            'manager_contact_no',
            'store_size_sft',
            'store_facade_feet',
            'number_sec',
            'number_rsa',
            'day_off',
            'connectivity_wifi'
        ],
    ]); ?>

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