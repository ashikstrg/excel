<?php

use yii\helpers\Html;

$this->title = 'Retail Upload';
$this->miniTitle = 'Retail Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Retail Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-batch-create">

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
                  <th>Channel Type</th>
                  <th>Retail Type</th>
                  <th>DMS Code</th>
                  <th>Name</th>
                  <th>Zone</th>
                  <th>Area</th>
                  <th>Territory</th>
                  <th>Location</th>
                  <th>Division</th>
                  <th>District</th>
                </tr>
                <tr>
                  <th>Thana</th>
                  <th>Market Name</th>
                  <th>Geo Tag</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Owner Name</th>
                  <th>Owner Contact No</th>
                  <th>Owner Email</th>
                  <th>Store Contact No</th>
                  <th>Store Email</th>
                </tr>
                <tr>
                  <th>Manager Name</th>
                  <th>Manager Contact No</th>
                  <th>Store Size (SFT)</th>
                  <th>Store Facade (Feet)</th>
                  <th>Number of SEC</th>
                  <th>Number of RSA</th>
                  <th>Day Off</th>
                  <th>Connectivity (wifi)</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header"><b>Conditions</b></div>
              <ul>
                  <li>If any data is missing type <b>"None".</b></li>
                  <li>Format as <b>"text"</b> to all <b>contact numbers.</b></li>
                  <li>If there is no <b>day off,</b> Type <b>"No Holiday".</b></li>
                  <li><b>Connectivity (wifi): Yes/No</b></li>
                  <li><b>Store Size (SFT)</b> must be an <b>integer number.</b></li>
                  <li><b>Store Facade (Feet)</b> must be an <b>integer number.</b></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


