<?php

use backend\assets\AppAssetLogin;
use yii\helpers\Html;

$asset = backend\assets\AppAssetLogin::register($this);
$baseUrl = $asset->baseUrl;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name; ?> | <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            .radio label, .checkbox label {
                padding-left: 0px;
            }
        </style>
    </head>
    <body class="hold-transition login-page">

        <?php $this->beginBody() ?>
        <?= $content; ?>
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
