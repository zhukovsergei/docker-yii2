<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class Arcticmodal extends AssetBundle
{
  public $css = [
    'js/arcticmodal/jquery.arcticmodal-0.3.css',
    'js/arcticmodal/themes/simple.css',
  ];

  public $js = [
    'js/arcticmodal/jquery.arcticmodal-0.3.min.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
