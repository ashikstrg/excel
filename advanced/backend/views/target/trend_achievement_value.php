<?php
use miloschuman\highcharts\Highcharts;

$year = date('Y', time());
$month = date('m', time());
$monthFullName = date('F', time());
if(!empty($searchModel->target_date)) {
    $monthYear = explode('-', $searchModel->target_date);
    $year = $monthYear[0];
    $month = $monthYear[1];
    $monthFullName = date('F', mktime(0, 0, 0, $monthYear[1], 10));
}

$this->title = 'Target VS Achievement Trend (Value)';
$this->miniTitle = 'Target Module';
$this->subTitle = '<b>Target Month: </b>' . $monthFullName . ', ' . $year;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-trend_achievement_value">
    
    <?php echo $this->render('_search_trend_achievement_value', ['model' => $searchModel]); ?>

    <?php  
    
    $currentMonth = date('m', time());
    $currentYear = date('Y', time());
    if($currentMonth ==  $month && $currentYear == $year) {
        $timePass = number_format(((date('d', time()) - 1) / date('t', time())) * 100, 2);
    } elseif(($currentMonth >  $month && $currentYear >= $year) || ($currentMonth <=  $month && $currentYear > $year)) {
        $timePass = 100;
    } else {
        $timePass = 0;
    }
    
    $employee_id = array();
    $targetVol = array();
    $achievementVol = array();
    foreach($dataProvider as $target) {
        $employee_id[] = $target->employee_id;
        $targetVol[] = (int) $target->fsm_val;
        $achievementVol[] = (int) $target->fsm_val_sales;
        $achievementPercent[] = (int) round($target->achievement_percent);
    }
    
    $height = count($dataProvider) * 100;
 
    echo Highcharts::widget([
       'scripts'=> ['highcharts-more', 'modules/exporting', 'modules/drilldown'],
       'options' => [
            'title' => ['text' => 'Time Pass: ' . $timePass . '%'],
            'xAxis' => [
               'categories' => $employee_id,
               'type' => 'category'
            ],
            'yAxis' => [
               'title' => ['text' => 'VALUE']
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
           'plotOptions' => array (
                'series' => array (
                    'borderWidth' => 0,
                    'dataLabels' => array(
                        'enabled' => true,
                    ),
                ),
            ), 
            'series' => [
               ['name' => 'Target', 'data' => $targetVol],
               ['name' => 'Achievement', 'data' => $achievementVol],
               ['name' => 'Achievement Percentage', 'data' => $achievementPercent]
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