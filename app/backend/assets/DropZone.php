<?php
namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;


class DropZone extends AssetBundle
{
    public $css = [
        'js/plugins/dropzone/5.7/min/dropzone.min.css',
    ];
    public $js = [
        'js/plugins/dropzone/5.7/min/dropzone.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        JqueryAsset::class,
    ];
}
