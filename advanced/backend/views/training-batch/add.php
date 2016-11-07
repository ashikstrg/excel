<?php

use yii\helpers\Html;

$this->title = 'Stock Data Upload';
$this->miniTitle = 'Training Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Training Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-batch-create">

    <?= $this->render('_form_add', [
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
                  <th style="width: 50%">Employee Type</th>
                  <th style="width: 50%">Employee ID</th>
                </tr>
                <tr>
                  <td>XXXXXXXXXXX</td>
                  <td>XXXXXXXXXXX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header"><b>Conditions</b></div>
              <ul>
                 <li>Employee Type must be Sales/FSM.</li>
                 <li>EMployee ID must exit in HR.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


