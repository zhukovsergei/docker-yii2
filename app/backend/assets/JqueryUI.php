<?php
namespace backend\assets;

use yii\web\AssetBundle;

class JqueryUI extends AssetBundle
{
  public $css = [
    '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css'
  ];

  public $js = [
    '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'
  ];

  public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
