<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HrManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'designation_id') ?>

    <?= $form->field($model, 'designation') ?>

    <?= $form->field($model, 'employee_type_id') ?>

    <?= $form->field($model, 'employee_type') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'joining_date') ?>

    <?php // echo $form->field($model, 'leaving_date') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'image_src_filename') ?>

    <?php // echo $form->field($model, 'image_web_filename') ?>

    <?php // echo $form->field($model, 'contact_no_official') ?>

    <?php // echo $form->field($model, 'contact_no_personal') ?>

    <?php // echo $form->field($model, 'name_immergency_contact_person') ?>

    <?php // echo $form->field($model, 'relation_immergency_contact_person') ?>

    <?php // echo $form->field($model, 'contact_no_immergency') ?>

    <?php // echo $form->field($model, 'email_address') ?>

    <?php // echo $form->field($model, 'email_address_official') ?>

    <?php // echo $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'graduation_status') ?>

    <?php // echo $form->field($model, 'educational_qualification') ?>

    <?php // echo $form->field($model, 'educational_institute') ?>

    <?php // echo $form->field($model, 'educational_qualification_second_last') ?>

    <?php // echo $form->field($model, 'educational_institute_second_last') ?>

    <?php // echo $form->field($model, 'previous_experience') ?>

    <?php // echo $form->field($model, 'previous_experience_two') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'present_address') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
