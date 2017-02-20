<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="upazilas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'district_id')->dropDownList($districtModel, ['prompt' => 'Select District']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
