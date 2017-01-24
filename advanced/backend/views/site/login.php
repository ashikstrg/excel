<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login Page';

?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?= Yii::$app->homeUrl; ?>">
    <img src="<?= Yii::$app->homeUrl . '/../img/logo.png'; ?>" />
    </a>
  </div><!– /.login-logo –>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      <div class="form-group has-feedback">
        <?= $form->field($model, 'username')->textInput(['class'=>'form-control', 'placeholder' => 'Username']);?>
      </div>
      <div class="form-group has-feedback">
        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder' => 'Password']) ?>
      </div>
      <div class="row">
        <div class="col-xs-8">    
          <div class="checkbox icheck">
            <label>
              <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </label>
          </div>                        
        </div><!– /.col –>
        <div class="col-xs-4">
          <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div><!– /.col –>
      </div>
    <?php ActiveForm::end(); ?>

  </div><!– /.login-box-body –>
  
</div><!– /.login-box –>