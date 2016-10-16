<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="retail-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'channel_type_id')->dropDownList($channelTypeModel, ['prompt' => 'Select Channel Type']); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]); ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Add Retail Type' : 'Update Retail Type', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
