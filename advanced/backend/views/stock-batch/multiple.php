<?php

use yii\helpers\Html;

$this->title = 'Stock Data Upload';
$this->miniTitle = 'Stock Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Stock Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-batch-multiple">

    <?= $this->render('_form_multiple', [
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
                  <th style="width: 50%">IMEI Number</th>
                  <th style="width: 50%">Retail DMS Code</th>
                </tr>
                <tr>
                  <td>XXXXXXXXXXXXXXX</td>
                  <td>XXXXXXX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header"><b>Conditions</b></div>
              <ul>
                 <li><b>IMEI Number</b> must be 15 characters long.</li>
                 <li><b>IMEI Number</b> must be unique.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


