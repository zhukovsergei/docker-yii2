<?php
namespace backend\assets;

use yii\web\AssetBundle;

class Dashboard extends AssetBundle
{
  public $js = [
    'js/dashboard.js',
  ];

  public $depends = [
    'backend\assets\Morris',
  ];
}
