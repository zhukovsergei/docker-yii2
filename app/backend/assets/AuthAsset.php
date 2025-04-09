<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';

  public $css = [
    '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
    'yii\bootstrap\BootstrapPluginAsset',
    'backend\assets\FastClick',
    'backend\assets\Pace',
    'backend\assets\Nifty',
    'backend\assets\FontAwesome',
  ];
}
