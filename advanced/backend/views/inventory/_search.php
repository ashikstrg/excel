<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InventorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'batch') ?>

    <?= $form->field($model, 'imei_no') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'product_model_code') ?>

    <?php // echo $form->field($model, 'product_model_name') ?>

    <?php // echo $form->field($model, 'product_color') ?>

    <?php // echo $form->field($model, 'product_type') ?>

    <?php // echo $form->field($model, 'lifting_price') ?>

    <?php // echo $form->field($model, 'rrp') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
