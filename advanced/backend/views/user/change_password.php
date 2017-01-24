<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reset Password';
$this->miniTitle = 'Profile';
$this->subTitle = 'Change Password';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput() ?>

    <?= $form->field($model, 'newPassword')->passwordInput() ?>

    <?= $form->field($model, 'newPasswordConfirm')->passwordInput() ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
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
