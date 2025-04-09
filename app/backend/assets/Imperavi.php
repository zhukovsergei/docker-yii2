<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Imperavi extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';

  public $css = [
    'js/imperavi/redactor.css',
  ];

  public $js = [
    'js/imperavi/redactor.js',
    'js/imperavi/de.js',
    'js/imperavi/plugins/table/table.js',
    'js/imperavi/plugins/video/video.js',
    'js/imperavi/plugins/fullscreen/fullscreen.js',
    'js/imperavi/plugins/fontsize/fontsize.js',
    'js/imperavi/plugins/fontfamily/fontfamily.js',
    'js/imperavi/plugins/fontcolor/fontcolor.js',
    'js/imperavi/plugins/erase/erase.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
