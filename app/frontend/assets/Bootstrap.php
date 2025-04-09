<?php
namespace frontend\assets;

use yii\bootstrap\BootstrapPluginAsset;

class Bootstrap extends BootstrapPluginAsset
{
  public $sourcePath = '@bower/bootstrap/dist';

  public $js = [
    'js/bootstrap.min.js',
  ];
  
  public $depends = [
    'yii\bootstrap\BootstrapAsset',
  ];
}
