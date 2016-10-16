<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'HR Detail';
$this->miniTitle = 'HR Module';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'HR Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-view">

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
            'bank_name',
            'bank_ac_name',
            'bank_ac_no',
            'bkash_no',
            'permanent_address',
            'present_address',
            'blood_group',
            'graduation_status',
            'educational_qualification',
            'educational_institute',
            'educational_qualification_second_last',
            'educational_institute_second_last',
            'previous_experience',
            'previous_experience_two',
            'tm_employee_id',
            'tm_name',     
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