<?php

use yii\helpers\Html;

$this->title = 'Upazila/Thana Add';
$this->miniTitle = 'Utility Module';
$this->subTitle = 'Upazila/Thana Form';

$this->params['breadcrumbs'][] = ['label' => 'Upazila Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-create">

    <?= $this->render('_form', [
        'model' => $model,
        'districtModel' => $districtModel
    ]) ?>

</div>
