<?php

use yii\helpers\Html;

$this->title = 'Complain Feedback';
$this->miniTitle = 'Complain Module';
$this->subTitle = 'Feedback Form: ' . $model->token_no;

$this->params['breadcrumbs'][] = ['label' => 'Complain List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complainbox-update">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
