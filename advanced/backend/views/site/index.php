<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'Dashboard';
$this->miniTitle = 'Control Panel';
$this->subTitle = '<b>Summary Report: </b>' . date('F', time());

$this->params['breadcrumbs'][] = $this->title;

$productTypeData = array();
foreach ($salesProductType as $sales) {
    array_push($productTypeData, ['name' => $sales->product_type, 'y' => (int) $sales->total]);
}

$timePass = round(((date('d', time()) - 1) / date('t', time())) * 100);

$currentDay = date('d', time());
$currentRate = round($target->fsm_val_sales/$currentDay);

$requiredAmount = $target->fsm_val - $target->fsm_val_sales;
$remainingDay = date('t', time()) - $currentDay;

$requiredRate = 0;
if($requiredAmount > 0 && $remainingDay > 0) {
    $requiredRate = $requiredAmount / $remainingDay;
} else if($requiredAmount > 0 && $remainingDay = 0) {
    $requiredRate = $requiredAmount;
} else {
    $requiredRate = 0;
}

?>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Today's Sale (Volume)</span>
                <span class="info-box-number">
                    <?php 
                    
                    if(!empty($todaysSalesReport)) {
                        echo $todaysSalesReport->total_vol;
                    }
                    
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-basket"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Today's Sale (Value)</span>
                <span class="info-box-number">
                    <?php
                    if(!empty($todaysSalesReport)) {
                        echo $todaysSalesReport->total_val;
                    }
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-university"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Current Rate</span>
                <span class="info-box-number"><?= round($currentRate); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bookmark"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Required Rate</span>
                <span class="info-box-number"><?= round($requiredRate); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $target->fsm_vol; ?></h3>

                <p>Total Target</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Volume</span>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $target->fsm_vol_sales; ?></h3>

                <p>Total Achievement</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Volume</span>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><span style="font-size: 15px;"><?= number_format($target->fsm_val, 2); ?></span></h3>
                <p>Total Target</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Value</span>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><span style="font-size: 15px;"><?= number_format($target->fsm_val_sales, 2); ?></span></h3>
                <p>Total Achievement</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <span href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Value</span>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-6">
        <!-- Achievement -->
        <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
                <i class="fa fa-bar-chart"></i>
                <h3 class="box-title">Achievement Percentage(%)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Progress bars -->

                        <div class="clearfix">
                            <span class="pull-left">Time Pass</span>
                            <small class="pull-right"><?= $timePass; ?>%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: <?= round($timePass); ?>%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Volume</span>
                            <small class="pull-right"><?= number_format($target->total_achv_percent, 2); ?>%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: <?= round($target->total_achv_percent); ?>%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Value</span>
                            <small class="pull-right"><?= number_format($target->total_achv_percent_value, 2); ?>%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: <?= round($target->total_achv_percent_value); ?>%;"></div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer">               
                <div class="row">
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                        <input type="text" class="knob" data-readonly="true" value="<?= number_format($timePass, 2); ?>" data-width="60" data-height="60" data-fgColor="#f39c12">

                        <div class="knob-label">Time Pass</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                        <input type="text" class="knob" data-readonly="true" value="<?= number_format($target->total_achv_percent, 2); ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

                        <div class="knob-label">Volume</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="<?= number_format($target->total_achv_percent_value, 2); ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

                        <div class="knob-label">Value</div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <!-- DONUT CHART -->
        <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
                <i class="fa fa-pie-chart"></i>
                <h3 class="box-title">Product Type Sales Ratio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Progress bars -->

                        <?php
                        echo Highcharts::widget([
                            'scripts' => ['highcharts-more', 'modules/exporting', 'modules/drilldown'],
                            'options' => [
                                'title' => ['text' => 'Pie Chart'],
                                'credits' => array('enabled' => false),
                                'exporting' => array('enabled' => true),
                                'chart' => array(
                                    'plotBackgroundColor' => '#ffffff',
                                    'plotBorderWidth' => null,
                                    'plotShadow' => true,
                                    'type' => 'pie',
                                    'height' => 248,
                                ),
                                //           'tooltip' => array(
                                //                'plotBackgroundColor' => '#ffffff',
                                //            ),
                                'plotOptions' => array(
                                    'pie' => array(
                                        'allowPointSelect' => true,
                                        'cursor' => 'pointer',
                                        'dataLabels' => array(
                                            'enabled' => true,
                                            'format' => '<b>{point.name}</b>: {point.percentage:.1f}%',
                                        ),
                                    ),
                                ),
                                'series' => [
                                    ['name' => 'Sales', 'data' => $productTypeData],
                                ]
                            ]
                        ]);
                        ?>

                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->

    </div>
</div>

<?php
// Register JS and CSS File
$asset = backend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->registerJsFile($baseUrl . '/plugins/knob/jquery.knob.js', ['depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]]);

$this->registerJs(' 
    $(document).ready(function(){
        $(".knob").knob();
    });', \yii\web\View::POS_READY);
