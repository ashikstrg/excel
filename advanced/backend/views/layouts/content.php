<?php 
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $this->title; ?>
      <small><?= $this->miniTitle; ?></small>
    </h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?= $this->subTitle; ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?= Alert::widget(); ?>
            <?= $content; ?>
          </div>
          <div class="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->