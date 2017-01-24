<?php

$this->title = 'Dashboard';
$this->miniTitle = 'Control Panel';
$this->subTitle = '<b>Assessment Report [Top 20]: </b>' . $assessmentCategoryModel->name . ' (' . date('F, Y', strtotime($assessmentCategoryModel->date_month)) . ')';

$this->params['breadcrumbs'][] = $this->title;

?>

<table class="table table-bordered">

    <tr>
        <th style="width: 10px">#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Score(Bar)</th>
        <th style="width: 80px">Score(%)</th>
    </tr>
    <?php
    
    $i = 00;
    foreach($assessmentResultModel as $result) {
        $i++;
        
        $progessBarColor = 'progress-bar-danger';
        $bgColor = 'bg-red';
        if( $result->score_percent < 50) {
            $progessBarColor = 'progress-bar-danger';
            $bgColor = 'bg-red';
        } else if( ($result->score_percent >= 50) && ($result->score_percent < 80) ) {
            $progessBarColor = 'progress-bar-yellow';
            $bgColor = 'bg-yellow';
        } else if( ($result->score_percent >= 80) && ($result->score_percent <= 100) ) {
            $progessBarColor = 'progress-bar-green';
            $bgColor = 'bg-green';
        }
        ?>
    
    <tr>
        <td><?= sprintf('%02d', $i); ?>.</td>
        <td><?= $result->hr_employee_id; ?></td>
        <td><?= $result->hr_name; ?></td>
        <td><?= $result->hr_designation; ?></td>
        <td>
            <div class="progress progress-xs">
                <div class="progress-bar <?= $progessBarColor; ?>" style="width: <?= round($result->score_percent) ?>%"></div>
            </div>
        </td>
        <td><span class="badge <?= $bgColor ?>"><?= round($result->score_percent) ?>%</span></td>
    </tr>
    
    <?php
    }
    
    ?>
    
</table>
