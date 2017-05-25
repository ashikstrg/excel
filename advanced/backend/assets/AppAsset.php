<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{

    public $sourcePath = '@bower/backend/';

    public $css = [
        //'bootstrap/css/bootstrap.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/ionicons/css/ionicons.min.css',
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',
        'plugins/iCheck/flat/blue.css',
        'dist/css/custom.css',
        // 'plugins/jvectormap/jquery-jvectormap-1.2.2.css', //Map Related data
        // 'plugins/datepicker/datepicker3.css', // Date Picker
        // 'plugins/daterangepicker/daterangepicker.css', // Date Range Picker
        // 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' // Editor
    ];
    public $js = [
        'plugins/input-mask/jquery.inputmask.js',
        'plugins/input-mask/jquery.inputmask.date.extensions.js',
        'plugins/input-mask/jquery.inputmask.extensions.js',
        'plugins/jQueryUI/jquery-ui.min.js',
        //'bootstrap/js/bootstrap.min.js',
        // 'plugins/sparkline/jquery.sparkline.min.js', // Chart Options
        // 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', // Map Related Data
        // 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js', // Map Related Data
        // 'plugins/knob/jquery.knob.js', // Calender/Timing
        // 'dist/js/moment.min.js', // Calender/Timing
        // 'plugins/daterangepicker/daterangepicker.js', // Date Picker
        // 'plugins/datepicker/bootstrap-datepicker.js', // Date Picker
        // 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', // Editor
        // 'plugins/slimScroll/jquery.slimscroll.min.js', // Height Scroll
        'plugins/fastclick/fastclick.js', // Smooth Touch
        'dist/js/app.min.js', // Theme Oriented
        //'dist/js/pages/dashboard.js',
        'dist/js/demo.js' // Right Side Settings
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
