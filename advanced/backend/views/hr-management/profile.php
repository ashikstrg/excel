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
        ],
    ]) ?>


    <div class="box-footer">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                <?= Html::a('Change Password', ['user/change_password'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

</div>