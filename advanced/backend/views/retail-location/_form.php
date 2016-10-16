<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="retail-location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'Enter Retail Location']) ?>

    <div class="box-footer">
    	<div class="row">
    		<div class="col-md-6">
    			<?= Html::submitButton($model->isNewRecord ? 'Add Retail Location' : 'Update Retail Location', ['class' => 'btn btn-primary']) ?>
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
