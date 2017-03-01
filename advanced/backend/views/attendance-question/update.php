<?php

$this->title = 'Update Question';
$this->miniTitle = 'Attendence Module';
$this->subTitle = 'Add Checklist Form';

$this->params['breadcrumbs'][] = ['label' => 'Question Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-question-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
