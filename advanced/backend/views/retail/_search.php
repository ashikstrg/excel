<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="retail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'channel_type') ?>

    <?= $form->field($model, 'retail_type') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'dms_code') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'retail_zone') ?>

    <?php // echo $form->field($model, 'retail_area') ?>

    <?php // echo $form->field($model, 'territory') ?>

    <?php // echo $form->field($model, 'retail_location') ?>

    <?php // echo $form->field($model, 'division') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'upazila') ?>

    <?php // echo $form->field($model, 'market_name') ?>

    <?php // echo $form->field($model, 'geotag') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'owner_name') ?>

    <?php // echo $form->field($model, 'owner_contact_no') ?>

    <?php // echo $form->field($model, 'owner_email') ?>

    <?php // echo $form->field($model, 'store_contact_no') ?>

    <?php // echo $form->field($model, 'store_email') ?>

    <?php // echo $form->field($model, 'manager_name') ?>

    <?php // echo $form->field($model, 'manager_contact_no') ?>

    <?php // echo $form->field($model, 'store_size_sft') ?>

    <?php // echo $form->field($model, 'store_facade_feet') ?>

    <?php // echo $form->field($model, 'number_sec') ?>

    <?php // echo $form->field($model, 'number_rsa') ?>

    <?php // echo $form->field($model, 'day_off') ?>

    <?php // echo $form->field($model, 'connectivity_wifi') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
