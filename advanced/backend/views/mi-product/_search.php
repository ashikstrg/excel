<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MiProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mi-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'brand') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'display_size') ?>

    <?= $form->field($model, 'display_type') ?>

    <?php // echo $form->field($model, 'generation') ?>

    <?php // echo $form->field($model, 'sim') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'ram') ?>

    <?php // echo $form->field($model, 'rom') ?>

    <?php // echo $form->field($model, 'processor') ?>

    <?php // echo $form->field($model, 'battery') ?>

    <?php // echo $form->field($model, 'camera_rear') ?>

    <?php // echo $form->field($model, 'camera_front') ?>

    <?php // echo $form->field($model, 'special_feature') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sale_out_vol') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'hr_id') ?>

    <?php // echo $form->field($model, 'hr_employee_id') ?>

    <?php // echo $form->field($model, 'hr_name') ?>

    <?php // echo $form->field($model, 'hr_designation') ?>

    <?php // echo $form->field($model, 'hr_employee_type') ?>

    <?php // echo $form->field($model, 'am_employee_id') ?>

    <?php // echo $form->field($model, 'am_name') ?>

    <?php // echo $form->field($model, 'csm_employee_id') ?>

    <?php // echo $form->field($model, 'csm_name') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
