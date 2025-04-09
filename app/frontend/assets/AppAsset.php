<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
//        'css/site.css',
    ];

    public $js = [
      'js/app.js',
    ];

    public $depends = [
      'yii\web\JqueryAsset',
//      'frontend\assets\JqueryUI',
//      'yii\bootstrap\BootstrapAsset',
//      'frontend\assets\Arcticmodal',
//      'frontend\assets\Bxslider',
    ];
}
