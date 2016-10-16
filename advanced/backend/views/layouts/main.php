<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

$asset = backend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name; ?> | <?= Html::encode($this->title); ?></title>
    <?php $this->head() ?>
    <style>
    .box-footer {
        padding: 10px 0px 10px 0px;
    }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= $this->render('header.php', ['baseUrl' => $baseUrl]); ?>
    <?= $this->render('leftmenu.php', ['baseUrl' => $baseUrl]); ?>
    <?= $this->render('content.php', ['content' => $content]); ?>
    <?= $this->render('footer.php', ['baseUrl' => $baseUrl]); ?>
    <?= $this->render('rightside.php', ['baseUrl' => $baseUrl]); ?>
    
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
