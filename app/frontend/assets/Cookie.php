<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class Cookie extends AssetBundle
{

  public $js = [
    'js/jquery.cookie.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];

}
