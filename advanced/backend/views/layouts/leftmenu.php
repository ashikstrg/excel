<?php 

use codezeen\yii2\adminlte\widgets\Menu;
use backend\components\MenuHelper;

$adminSiteMenu = MenuHelper::getMenu();

ksort($adminSiteMenu);

?>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= Yii::$app->homeUrl. '/../uploads/hr/'. Yii::$app->session->get('image_web_filename'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= Yii::$app->session->get('name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?= Menu::widget(['items' => $adminSiteMenu]); ?>
    </section>
    <!-- /.sidebar -->
  </aside>