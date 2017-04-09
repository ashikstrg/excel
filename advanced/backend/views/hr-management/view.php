<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'HR Detail (Management)';
$this->miniTitle = 'HR Module';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'HR Configuration (Management)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-management-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'employee_id',
            'name',
            'employee_type',
            'designation',
            'joining_date',
            'leaving_date',
            'contact_no_official',
            'contact_no_personal',
            'name_immergency_contact_person',
            'relation_immergency_contact_person',
            'contact_no_immergency',
            'email_address_official:email',
            'email_address:email',
            'permanent_address',
            'present_address',
            'blood_group',   
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

    <?php
       if ($model->image_web_filename!='') {
         echo '<br /><p><img src="'.Yii::$app->homeUrl. '/../uploads/hr/'.$model->image_web_filename.'"></p>';
       }    
    ?>


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