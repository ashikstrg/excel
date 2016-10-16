<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChannelType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Enter Channel Type']); ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Add Channel Type' : 'Update Channel Type', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
