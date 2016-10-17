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
                  <th style="width: 50%">Model Code</th>
                  <th style="width: 50%">Target</th>
                </tr>
                <tr>
                  <td>XXXXXXXXXXX</td>
                  <td>1XXXXX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header">Conditions</div>
              <ul>
                <li>Product Model must be exist in the product list.</li>
                <li>Target must be an integer value.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>
