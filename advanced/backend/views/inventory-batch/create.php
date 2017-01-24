<?php

use yii\helpers\Html;

$this->title = 'Inventory Data Upload';
$this->miniTitle = 'Inventory Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Inventory Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-batch-create">

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
                  <th style="width: 40%">IMEI Number</th>
                  <th style="width: 30%">Product Model Code</th>
                  <th style="width: 30%">Color</th>
                </tr>
                <tr>
                  <td>XXXXXXXXXXXXXXX</td>
                  <td>XXXXXXXXXX</td>
                  <td>XXXXXXXXXX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header"><b>Conditions</b></div>
              <ul>
                 <li><b>IMEI Number</b> must be 15 characters long.</li>
                 <li><b>IMEI Number</b> must be unique.</li>
                 <li><b>Product Model Code and color </b> must be exist in the database.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


