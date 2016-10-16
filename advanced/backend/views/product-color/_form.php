<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="product-color-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
    	<div class="row">
    		<div class="col-md-6">
    			<?= Html::submitButton($model->isNewRecord ? 'Add Product Color' : 'Update Product Color', ['class' => 'btn btn-primary']) ?>
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