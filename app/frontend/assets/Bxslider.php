<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class Bxslider extends AssetBundle
{
  public $css = [
    'js/bxslider/jquery.bxslider.css',
  ];

  public $js = [
    'js/bxslider/jquery.bxslider.min.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
