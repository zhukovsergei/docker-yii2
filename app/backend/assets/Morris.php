<?php
namespace backend\assets;

use yii\web\AssetBundle;

class Morris extends AssetBundle
{
  public $css = [
    'js/plugins/morris-js/morris.min.css',
  ];

  public $js = [
    'js/plugins/morris-js/morris.min.js',
    'js/plugins/morris-js/raphael-js/raphael.min.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
