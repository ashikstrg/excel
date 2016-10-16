<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Reset Password';
?>

<div class="user-form">

	<?= Alert::widget(); ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput() ?>

    <?= $form->field($model, 'newPassword')->passwordInput() ?>

    <?= $form->field($model, 'newPasswordConfirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
