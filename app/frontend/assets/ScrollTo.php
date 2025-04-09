<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ScrollTo extends AssetBundle
{

  public $js = [
    'js/jquery.scrollTo.min.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];

}
