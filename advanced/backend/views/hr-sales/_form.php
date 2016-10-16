<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url; 
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;

?>

<div class="hr-sales-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'designation_id')->dropDownList($hrDesignationModel, [
            'prompt' => 'Select Deignation'
            ]); ?>

            <?= $form->field($model, 'manager_id')->widget(DepDrop::classname(), [
                'options'=>['placeholder'=>'At First Select Designation'],
                'data'=>[$model->manager_id => $model->manager_id . ' - ' . $model->manager_name],
                'pluginOptions'=>[
                    'depends'=>['hrsales-designation_id'],
                    'placeholder'=>'Select Manager',
                    'url'=>Url::to(['/hr-sales/find_manager'])
                ]
            ]); ?>

            <?= $form->field($model, 'employee_id')->textInput(['placeholder' => 'Enter Employee ID', 'maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(['' => 'Select Status', 'Active' => 'Active', 'Inactive' => 'Inactive', 'Resigned' => 'Resigned']) ?>

            <?= $form->field($model, 'joining_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter Joining Date'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'leaving_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter Leaving Date'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                  'options' => ['accept' => 'image/*'],
                   'pluginOptions' => [
                        'allowedFileExtensions'=>['jpg','gif','png'],
                        'showUpload' => false,
                        'initialPreview' => [
                            $model->image_web_filename ? Html::img(Yii::$app->homeUrl . '/../uploads/hr/' . $model->image_web_filename) : null, // checks the models to display the preview
                        ],
                        'overwriteInitial' => false,
                    ],
              ]);   ?>

            <?= $form->field($model, 'contact_no_official')->textInput(['placeholder' => 'Enter Contact No (Official)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'contact_no_personal')->textInput(['placeholder' => 'Enter Contact No (Personal)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'name_immergency_contact_person')->textInput(['placeholder' => 'Enter Name (Emergency Contact Person)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'relation_immergency_contact_person')->textInput(['placeholder' => 'Enter Relation (Emergency Contact Person)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'contact_no_immergency')->textInput(['placeholder' => 'Enter Contact No (Emergency Contact Person)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'email_address_official')->textInput(['placeholder' => 'Enter Official Email Address', 'maxlength' => true]) ?>

            <?= $form->field($model, 'email_address')->textInput(['placeholder' => 'Enter Personal Email Address', 'maxlength' => true]) ?>

            

        </div>

        <div class="col-md-6">
            
            <?= $form->field($model, 'bank_name')->textInput(['placeholder' => 'Enter Bank Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'bank_ac_name')->textInput(['placeholder' => 'Enter Bank Account Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'bank_ac_no')->textInput(['placeholder' => 'Enter Bank Account Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'bkash_no')->textInput(['placeholder' => 'Enter Bkash Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'blood_group')->dropDownList(['' => 'Select Blood Group', 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-']) ?>

            <?= $form->field($model, 'graduation_status')->dropDownList(['' => 'Select Graduation Status', 'Graduated' => 'Graduated', 'Pursuing' => 'Pursuing']); ?>

            <?= $form->field($model, 'educational_qualification')->textInput(['placeholder' => 'Enter Educational Qualification', 'maxlength' => true]) ?>

            <?= $form->field($model, 'educational_institute')->textInput(['placeholder' => 'Enter Educational Institute', 'maxlength' => true]) ?>

            <?= $form->field($model, 'educational_qualification_second_last')->textInput(['placeholder' => 'Enter Educational Qualification (2nd Last)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'educational_institute_second_last')->textInput(['placeholder' => 'Enter Educational Institute (2nd Last)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'previous_experience')->textInput(['placeholder' => 'Enter Previous Experience (Number of Months)']) ?>

            <?= $form->field($model, 'previous_experience_two')->textInput(['placeholder' => 'Enter Previous Experience 2 (Number of Months)']) ?>

            <?= $form->field($model, 'permanent_address')->textInput(['placeholder' => 'Enter Permanent Address', 'maxlength' => true]) ?>

            <?= $form->field($model, 'present_address')->textInput(['placeholder' => 'Enter Present Address', 'maxlength' => true]) ?>

        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add HR (Sales)' : 'Update HR (Sales)', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::resetButton('Reset Form', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>