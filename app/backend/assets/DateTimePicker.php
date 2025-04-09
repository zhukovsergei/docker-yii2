<?php
namespace backend\assets;

use yii\web\AssetBundle;

class DateTimePicker extends AssetBundle
{
  public $sourcePath = '@bower/datetimepicker';


  public $css = [
    'build/jquery.datetimepicker.min.css'
  ];

  public $js = [
    'build/jquery.datetimepicker.full.min.js'
  ];

//  public $jsOptions = ['position' => \yii\web\View::POS_HEAD];


  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
