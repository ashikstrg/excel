<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Profile';
$this->miniTitle = 'Detail View';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-sales-view">
    
    <?php
       if ($model->image_web_filename!='') {
         echo '<br /><p><img src="'.Yii::$app->homeUrl. '/../uploads/hr/'.$model->image_web_filename.'"></p>';
       }    
    ?>

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
            'manager_id',
            'manager_name',
            'manager_designation',        
            'status',
        ],
    ]) ?>


    <div class="box-footer">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                <?= Html::a('Change Password', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

</div>