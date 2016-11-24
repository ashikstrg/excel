<?php

use yii\helpers\Html;

$this->title = 'Notice';
$this->subTitle = $name;
$this->miniTitle = 'Error Module';

?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
