<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\bootstrap\BootstrapPluginAsset;

class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';

  public $css = [
    '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin',
    'js/plugins/animate-css/animate.min.css',
    'js/plugins/bootstrap-select/bootstrap-select.min.css',
    'css/adobe.css',
  ];

  public $js = [
    'js/plugins/bootstrap-select/bootstrap-select.min.js',
    'js/app.js',
  ];

  public $depends = [
      JqueryAsset::class,
//    'yii\bootstrap\BootstrapAsset',
      BootstrapPluginAsset::class,
//    'backend\assets\JqueryUI',
      FastClick::class,
      Nifty::class,
      Switchery::class,
      DateTimePicker::class,
      Pace::class,
      FontAwesome::class,
      DataTables::class,
      DropZone::class,
      TuiImageEditor::class,
  ];
}
