<?php
namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;


class TuiImageEditor extends AssetBundle
{
    public $css = [
        '//uicdn.toast.com/tui-color-picker/v2.2.3/tui-color-picker.css',
        '/js/plugins/tui.image-editor/dist/tui-image-editor.css',
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/fabric.js/3.3.2/fabric.js',
        '//uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.min.js',
        '//uicdn.toast.com/tui-color-picker/v2.2.3/tui-color-picker.js',
        '//cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js',
        '/js/plugins/tui.image-editor/dist/tui-image-editor.js',

//        '/js/plugins/tui.image-editor/examples/js/theme/white-theme.js',
        '/js/plugins/tui.image-editor/examples/js/theme/black-theme.js',
    ];

//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
//        JqueryAsset::class,
    ];
}
