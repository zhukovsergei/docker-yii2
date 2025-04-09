<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryUI extends AssetBundle
{
  public $css = [
    '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/redmond/jquery-ui.css'
  ];

  public $js = [
    '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js'
  ];

  public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
