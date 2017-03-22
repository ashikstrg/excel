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

$this->title = 'Target VS Achievement Trend (Volume)';
$this->miniTitle = 'Target Module';
$this->subTitle = '<b>Target Month: </b>' . $monthFullName . ', ' . $year;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-trend_achievement">

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

    $employee_id = array();
    $targetVol = array();
    $achievementVol = array();
    $achievementPercent = array();
    foreach ($dataProvider as $target) {
        $employee_id[] = $target->employee_id;
        $targetVol[] = (int) $target->fsm_vol;
        $achievementVol[] = (int) $target->fsm_vol_sales;
        $achievementPercent[] = (int) round($target->achievement_percent);
    }

    $height = count($dataProvider) * 80;

    echo Highcharts::widget([
        'scripts' => ['highcharts-more', 'modules/exporting', 'modules/drilldown'],
        'options' => [
            'title' => ['text' => 'Time Pass: ' . $timePass . '%'],
            'xAxis' => [
                'categories' => $employee_id,
                'type' => 'category'
            ],
            'yAxis' => [
                'title' => ['text' => 'VOLUME']
            ],
            'colors' => array('#6AC36A', '#FFD148', '#3C8DBC'),
            'gradient' => array('enabled' => true),
            'credits' => array('enabled' => false),
            'exporting' => array('enabled' => true),
            'legend' => array('enabled' => true),
            'chart' => array(
                'plotBackgroundColor' => '#ffffff',
                'plotBorderWidth' => null,
                'plotShadow' => true,
                'type' => 'bar',
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
                ['name' => 'Target', 'data' => $targetVol],
                ['name' => 'Achievement', 'data' => $achievementVol],
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
            <i>* FSM ID wise Target VS Achievement.</i>
        </div>
    </div>
</div>