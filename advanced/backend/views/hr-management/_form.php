<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HrManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'designation_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_type_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', 'Resigned' => 'Resigned', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'joining_date')->textInput() ?>

    <?= $form->field($model, 'leaving_date')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_src_filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_web_filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_no_official')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_no_personal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_immergency_contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relation_immergency_contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_no_immergency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_address_official')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'graduation_status')->dropDownList([ 'Graduated' => 'Graduated', 'Pursuing' => 'Pursuing', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'educational_qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'educational_institute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'educational_qualification_second_last')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'educational_institute_second_last')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'previous_experience')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'previous_experience_two')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permanent_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'present_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
