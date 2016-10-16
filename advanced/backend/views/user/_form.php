<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]); ?>

<?= $form->field($model, 'email'); ?>

<?= $form->field($model, 'password')->passwordInput(); ?>

<?= $form->field($model, 'role')->dropDownList($userRoleModel, ['prompt' => 'Select User Role']); ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

