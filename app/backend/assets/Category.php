<?php
namespace backend\assets;

use yii\web\AssetBundle;

class Category extends AssetBundle
{
  public $js = [
    'js/category.js',
  ];

  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
