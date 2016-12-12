<?php

use yii\helpers\Html;

$this->title = 'Target Data Upload';
$this->miniTitle = 'Target Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Target Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="target-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>

<div class="row" style="margin-top: 40px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Format</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 40%">Employee ID (FSM)</th>
                  <th style="width: 30%">Model Code 1</th>
                  <th style="width: 30%">Model Code 2</th>
                </tr>
                <tr>
                  <td>IDXXXX</td>
                  <td>1XX</td>
                  <td>1XX</td>
                </tr>
                <tr>
                  <td>IDXXXX</td>
                  <td>1XX</td>
                  <td>1XX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header">Conditions</div>
              <ul>
                <li>FSM Employee ID must exist in the database.</li>
                <li>Product Model must exist in the product list.</li>
                <li>Target must be an integer value.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>
