<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="hr-designation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_type_id')->dropDownList($hrEmployeeTypeModel, ['prompt' => 'Select Employee Type']); ?>

    <?= $form->field($model, 'parent')->dropDownList($hrDesignationModel, ['prompt' => 'Select Hierarchy']); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
    	<div class="row">
    		<div class="col-md-6">
    			<?= Html::submitButton($model->isNewRecord ? 'Add Designation' : 'Update Designation', ['class' => 'btn btn-primary']) ?>
    		</div>
    		<div class="col-md-6">
    			<div class="pull-right">
    			<?= Html::resetButton('Reset Form', ['class' => 'btn btn-danger']); ?>
    			</div>
    		</div>
    	</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>