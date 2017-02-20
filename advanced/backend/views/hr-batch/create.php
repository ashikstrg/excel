<?php

use yii\helpers\Html;

$this->title = 'HR Upload';
$this->miniTitle = 'HR Module';
$this->subTitle = 'FSM Form';

$this->params['breadcrumbs'][] = ['label' => 'HR Batch Data (FSM)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-batch-create">

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
                  <th>DMS Code</th>
                  <th>Designation</th>
                  <th>Employee ID</th>
                  <th>TM Employee ID</th>
                  <th>FSM Name</th>
                  <th>Joining Date</th>
                  <th>Contact No (Official)</th>
                  <th>Contact No (Personal)</th>
                  <th>Name (Emergency Contact Person)</th>
                </tr>
                <tr>
                  <th>Relation (Emergency Contact Person)</th>
                  <th>Contact No (Emergency Contact Person)</th>
                  <th>Email</th>
                  <th>Email (Official)</th>
                  <th>Bank Name</th>
                  <th>Bank AC Name</th>
                  <th>Bank AC No</th>
                  <th>Bkash No</th>
                  <th>Blood Group</th>
                </tr>
                <tr>
                  <th>Graduation Status</th>
                  <th>Educational Qualification</th>
                  <th>Educational Institute</th>
                  <th>Educational Qualification (2nd Last)</th>
                  <th>Educational Institute (2nd Last)</th>
                  <th>Previous Experience</th>
                  <th>Previous Experience (2nd Last)</th>
                  <th>Permanent Address</th>
                  <th>Present Address</th>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header"><b>Conditions</b></div>
              <ul>
                  <li>If any data is missing type <b>"None".</b></li>
                  <li>Format as <b>"text"</b> to all <b>contact numbers.</b></li>
                  <li><b>Graduation Status: Graduated/Pursuing.</b></li>
                  <li><b>Date Format</b> must be <b>yyyy-mm-dd.</b></li>
                  <li><b>Previous Experience and Previous Experience Second Last </b> must be an <b>integer number.</b></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


