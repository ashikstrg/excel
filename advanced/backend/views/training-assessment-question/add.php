<?php

$this->title = 'Add Assessment Question';
$this->miniTitle = 'Assessment Module';
$this->subTitle = '<b>Assessment Name: </b>' . $trainingAssessmentCategoryModel->name;

$this->params['breadcrumbs'][] = ['label' => 'Training PDF Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="training-assessment-question-add">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
