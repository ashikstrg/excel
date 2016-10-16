<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url; 

?>

<div class="retail-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'channelType')->dropDownList($channelTypeModel, [
            'prompt' => 'Select Channel Type'
            ]); ?>

            <?= $form->field($model, 'retailType')->widget(DepDrop::classname(), [
                'options'=>['placeholder'=>'At First Select Channel Type'],
                'data'=>[$model->retailType => $model->retail_type],
                'pluginOptions'=>[
                    'depends'=>['retail-channeltype'],
                    'placeholder'=>'Select Retail Type',
                    'url'=>Url::to(['/retail/retail_type'])
                ]
            ]); ?>

            <?= $form->field($model, 'dms_code')->textInput(['placeholder' => 'Enter Retail DMS Code', 'maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter Retail Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'retailZone')->dropDownList($retailZoneModel, ['prompt' => 'Select Retail Zone']) ?>

            <?= $form->field($model, 'retailArea')->dropDownList($retailAreaModel, ['prompt' => 'Select Retail Area']) ?>
 
            <?= $form->field($model, 'territory')->textInput(['placeholder' => 'Enter Retail Territory', 'maxlength' => true]) ?>

            <?= $form->field($model, 'retailLocation')->dropDownList($retailLocationModel, ['prompt' => 'Select Retail Location']) ?>

            <?= $form->field($model, 'divisionProperty')->dropDownList($divisionsModel, ['prompt' => 'Select Division']) ?>

            <?= $form->field($model, 'districtProperty')->widget(DepDrop::classname(), [
                'options'=>['placeholder'=>'At First Select Division'],
                'data'=>[$model->districtProperty => $model->district],
                'pluginOptions'=>[
                    'depends'=>['retail-divisionproperty'],
                    'placeholder'=>'Select District',
                    'url'=>Url::to(['/retail/district'])
                ]
            ]); ?>

            <?= $form->field($model, 'upazilaProperty')->widget(DepDrop::classname(), [
                'options'=>['placeholder'=>'At First Select District'],
                'data'=>[$model->upazilaProperty => $model->upazila],
                'pluginOptions'=>[
                    'depends'=>['retail-districtproperty'],
                    'placeholder'=>'Select Upazila',
                    'url'=>Url::to(['/retail/upazila'])
                ]
            ]); ?>


            <?= $form->field($model, 'market_name')->textInput(['placeholder' => 'Enter Retail Market Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'geotag')->textInput(['placeholder' => 'Enter Retail Geotag', 'maxlength' => true]) ?>

            <?= $form->field($model, 'Address')->textInput(['placeholder' => 'Enter Retail Address', 'maxlength' => true]) ?>

        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'contact_no')->textInput(['placeholder' => 'Enter Contact Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'owner_name')->textInput(['placeholder' => 'Enter Retail Owner Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'owner_contact_no')->textInput(['placeholder' => 'Enter Retail Owner Contact Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'owner_email')->textInput(['placeholder' => 'Enter Retail Owner Email Address', 'maxlength' => true]) ?>

            <?= $form->field($model, 'store_contact_no')->textInput(['placeholder' => 'Enter Store Contact Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'store_email')->textInput(['placeholder' =>  'Enter Store Email Address', 'maxlength' => true]) ?>

            <?= $form->field($model, 'manager_name')->textInput(['placeholder' => 'Enter Retail Manager Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'manager_contact_no')->textInput(['placeholder' => 'Enter Retail Manager Contact Number', 'maxlength' => true]) ?>

            <?= $form->field($model, 'store_size_sft')->textInput(['placeholder' => 'Enter Store Size (SFT)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'store_facade_feet')->textInput(['placeholder' => 'Enter Store Facade (Feet)', 'maxlength' => true]) ?>

            <?= $form->field($model, 'number_sec')->dropDownList(range(1, 10), ['prompt' => 'Select Number of SEC']) ?>

            <?= $form->field($model, 'number_rsa')->dropDownList(range(1, 10), ['prompt' => 'Select Number of RSA']) ?>

            <?= $form->field($model, 'day_off')->dropDownList(['Saturday' => 'Saturday', 'Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday'], ['prompt' => 'Select Day Off']) ?>

            <?= $form->field($model, 'connectivity_wifi')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Select Connectivity (Wifi)']) ?>

        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Retail' : 'Update Retail', ['class' => 'btn btn-primary']) ?>
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


