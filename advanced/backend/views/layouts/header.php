<?php
use yii\helpers\Html;

use backend\models\Notification;
use backend\components\Common;

$employeeID = Yii::$app->session->get('employee_id');

$notificationModel = Notification::find()->where(
        'hr_employee_id=:hr_employee_id AND read_status=:read_status', 
        [':hr_employee_id' => $employeeID, ':read_status' => 'Unread'])
        ->limit(11)
        ->orderBy(['id' => SORT_DESC])
        ->all();

$notificationCount = count($notificationModel);
if($notificationCount > 10) {
    $notificationTotal = '10+';
} else {
    $notificationTotal = $notificationCount;
}

?>

<header class="main-header">
    <!-- Logo -->
    <?= Html::a('<span class="logo-mini">EXL</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                  </ul>
              </li>
          </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success"><?= $notificationTotal; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?= $notificationTotal; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <?php 
                    
                    foreach ($notificationModel as $notification) {
                        
                        ?>

                    <li><!-- start message -->
                      <a href="<?= Yii::$app->homeUrl. $notification->url . '&ntid=' . $notification->id; ?>">
                        <div class="pull-left">
                          <img src="<?= Yii::$app->homeUrl. '/../uploads/hr/'. $notification->image_web_filename; ?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          <?= $notification->created_by_name; ?>
                            <small><i class="fa fa-clock-o"></i> <?= Common::get_timeago(strtotime($notification->created_at)); ?></small>
                        </h4>
                        <p><?= $notification->message; ?></p>
                      </a>
                    </li>
                  <!-- end message -->
                  <?php 
                  
                    }
                  
                  ?>
                </ul>
              </li>
              <li class="footer"><?= Html::a('View All', ['/notification/all']) ?></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
<!--          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-warning"><?= $notificationTotal; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?= $notificationTotal; ?> messages</li>
              <li>
                 inner menu: contains the actual data 
                <ul class="menu">
                    <?php
                    foreach ($notificationModel as $notification) {
                        
                        ?>
                    <li>
                      <a href="<?= Yii::$app->homeUrl. $notification->url; ?>">
                        <i class="fa fa-users text-aqua"></i> <?= $notification->message; ?>
                      </a>
                    </li>
                    <?php
                      
                    }
                    ?>
                    
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>-->
          <!-- Tasks: style can be found in dropdown.less -->
<!--          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                 inner menu: contains the actual data 
                <ul class="menu">
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   end task item 
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   end task item 
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   end task item 
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   end task item 
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= Yii::$app->homeUrl. '/../uploads/hr/'. Yii::$app->session->get('image_web_filename'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= Yii::$app->session->get('name'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= Yii::$app->homeUrl. '/../uploads/hr/'. Yii::$app->session->get('image_web_filename'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= Yii::$app->session->get('name'); ?> - <?= Yii::$app->session->get('designation'); ?>
                  <small>Member since <?= date('d.m.Y', strtotime(Yii::$app->session->get('joining_date'))); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
<!--              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Summery</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Target</a>
                  </div>
                </div>
                 /.row 
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <?php
                    
                    if(Yii::$app->session->get('userRole') == 'Sales'){
                        echo Html::a(
                                'Profile', ['/hr-sales/profile', 'id' => Yii::$app->session->get('hrId')], ['class' => 'btn btn-default btn-flat']
                        );
                    } else if(Yii::$app->session->get('userRole') == 'FSM'){
                        echo Html::a(
                                'Profile', ['/hr/profile', 'id' => Yii::$app->session->get('hrId')], ['class' => 'btn btn-default btn-flat']
                        );
                    } else if(Yii::$app->session->get('userRole') == 'admin') {
                        echo Html::a(
                                'Profile', ['/hr-management/profile', 'id' => Yii::$app->session->get('hrId')], ['class' => 'btn btn-default btn-flat']
                        );
                    }
                    else if(Yii::$app->session->get('userRole') == 'Trainer') {
                        echo Html::a(
                                'Profile', ['/hr-trainer/profile', 'id' => Yii::$app->session->get('hrId')], ['class' => 'btn btn-default btn-flat']
                        );
                    }
                    ?>
                </div>
                <div class="pull-right">
                  <?= Html::a(
                      'Sign out',
                      ['/site/logout'],
                      ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                  ) ?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<!--          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>