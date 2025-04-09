<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class Redactor extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';

  public $css = [
    'js/redactor/redactor/redactor.css',
  ];

  public $js = [
    'js/redactor/redactor/redactor.js',
    'js/redactor/redactor/_langs/de.js',

    'js/redactor/redactor-plugins/alignment/alignment.min.js',
    'js/redactor/redactor-plugins/counter/counter.min.js',
    'js/redactor/redactor-plugins/filemanager/filemanager.min.js',
    'js/redactor/redactor-plugins/alignment/alignment.min.js',
    'js/redactor/redactor-plugins/fontcolor/fontcolor.min.js',
    'js/redactor/redactor-plugins/fontfamily/fontfamily.min.js',
    'js/redactor/redactor-plugins/fontsize/fontsize.min.js',
    'js/redactor/redactor-plugins/alignment/alignment.min.js',
    'js/redactor/redactor-plugins/inlinestyle/inlinestyle.min.js',
    'js/redactor/redactor-plugins/fullscreen/fullscreen.min.js',
    'js/redactor/redactor-plugins/imagemanager/imagemanager.min.js',
    'js/redactor/redactor-plugins/specialchars/specialchars.min.js',
    'js/redactor/redactor-plugins/table/table.min.js',
    'js/redactor/redactor-plugins/video/video.min.js',
    'js/redactor/redactor-plugins/widget/widget.min.js',
  ];

  public $depends = [
      JqueryAsset::class,
  ];
}
