<?php

use miloschuman\highcharts\Highcharts;

$year = date('Y', time());
$month = date('m', time());
$monthFullName = date('F', time());
if (!empty($searchModel->target_date)) {
    $monthYear = explode('-', $searchModel->target_date);
    $year = $monthYear[0];
    $month = $monthYear[1];
    $monthFullName = date('F', mktime(0, 0, 0, $monthYear[1], 10));
}

$this->title = 'Graphical Report by Value';
$this->miniTitle = 'Target VS Achievement';
$this->subTitle = '<b>Target Month: </b>' . $monthFullName . ', ' . $year;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="target-trend_achv_model_val">

    <?php echo $this->render('_search_trend_achievement', ['model' => $searchModel]); ?>

    <?php
    $currentMonth = date('m', time());
    $currentYear = date('Y', time());
    if ($currentMonth == $month && $currentYear == $year) {
        $timePass = round(((date('d', time()) - 1) / date('t', time())) * 100);
    } elseif (($currentMonth > $month && $currentYear >= $year) || ($currentMonth <= $month && $currentYear > $year)) {
        $timePass = 100;
    } else {
        $timePass = 0;
    }

    $productModelName = array();
    $targetVal = array();
    $achievementVal = array();
    $achievementPercent = array();
    foreach ($dataProvider as $target) {
        $productModelName[] = $target->product_model_name;
        $targetVal[] = (int) $target->fsm_val;
        $achievementVal[] = (int) $target->fsm_val_sales;
        $achievementPercent[] = (int) round($target->achievement_percent);
    }

    $height = count($dataProvider) * 80;

    echo Highcharts::widget([
        'scripts' => ['highcharts-more', 'modules/exporting', 'modules/drilldown'],
        'options' => [
            'title' => ['text' => 'Time Pass: ' . $timePass . '%'],
            'xAxis' => [
                'categories' => $productModelName,
                'type' => 'category'
            ],
            'yAxis' => [
                'title' => ['text' => 'Value']
            ],
            'colors' => array('#6AC36A', '#FFD148','#3C8DBC'),
            'gradient' => array('enabled' => true),
            'credits' => array('enabled' => false),
            'exporting' => array('enabled' => true),
            'legend' => array('enabled' => true),
            'chart' => array(
                'plotBackgroundColor' => '#ffffff',
                'plotBorderWidth' => null,
                'plotShadow' => true,
                //'type' => 'bar',
                'height' => $height,
                'zoomType' => 'x'
            ),
            'plotOptions' => array(
                'series' => array(
                    'borderWidth' => 0,
                    'dataLabels' => array(
                        'enabled' => true,
                    ),
                ),
            ),

            'series' => [
                ['type' => 'bar', 'name' => 'Target', 'data' => $targetVal],
                ['type' => 'bar', 'name' => 'Achievement', 'data' => $achievementVal],
                [
                    'type' => 'line',
                    'name' => 'Achievement Percentage',
                    'tooltip' => [
                        'pointFormat' => '<span style="color:{series.color}">{series.name}: </span>{point.y}%<br/>',
                    ],
                    'dataLabels' => [
                        'formatter' => new yii\web\JsExpression('function(){ return this.y + "%"; }')
                    ],
                    'data' => $achievementPercent,
                ]
            ]
        ]
    ]);
    ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Product Model wise Target VS Achievement Trend.</i>
        </div>
    </div>
</div>