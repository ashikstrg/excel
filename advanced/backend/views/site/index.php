<?php

$this->title = 'Dashboard';
$this->miniTitle = 'Control Panel';
$this->subTitle = '<b>Summery Report ' . '[' . date('F') . ']</b>: ' .  number_format($target->total_achv_percent, 2) . '% by volume &amp; ' . number_format($target->total_achv_percent_value, 2) .'% by value';

$this->params['breadcrumbs'][] = $this->title;
 
?>
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
