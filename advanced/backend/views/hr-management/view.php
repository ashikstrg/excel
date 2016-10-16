<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HrManagement */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hr Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'designation_id',
            'designation',
            'employee_type_id',
            'employee_type',
            'employee_id',
            'name',
            'status',
            'joining_date',
            'leaving_date',
            'image',
            'image_src_filename',
            'image_web_filename',
            'contact_no_official',
            'contact_no_personal',
            'name_immergency_contact_person',
            'relation_immergency_contact_person',
            'contact_no_immergency',
            'email_address:email',
            'email_address_official:email',
            'blood_group',
            'graduation_status',
            'educational_qualification',
            'educational_institute',
            'educational_qualification_second_last',
            'educational_institute_second_last',
            'previous_experience',
            'previous_experience_two',
            'permanent_address',
            'present_address',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'user_id',
        ],
    ]) ?>

</div>
