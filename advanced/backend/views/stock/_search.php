<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'batch') ?>

    <?= $form->field($model, 'retail_id') ?>

    <?= $form->field($model, 'retail_dms_code') ?>

    <?= $form->field($model, 'retail_name') ?>

    <?php // echo $form->field($model, 'retail_type') ?>

    <?php // echo $form->field($model, 'retail_channel_type') ?>

    <?php // echo $form->field($model, 'retail_zone') ?>

    <?php // echo $form->field($model, 'retail_area') ?>

    <?php // echo $form->field($model, 'retail_territory') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'product_model_code') ?>

    <?php // echo $form->field($model, 'product_model_name') ?>

    <?php // echo $form->field($model, 'product_color') ?>

    <?php // echo $form->field($model, 'product_type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'submission_date') ?>

    <?php // echo $form->field($model, 'cretated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
