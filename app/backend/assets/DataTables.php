<?php
namespace backend\assets;

use yii\web\AssetBundle;

class DataTables extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'js/plugins/datatables/media/css/dataTables.bootstrap.min.css',
    'js/plugins/datatables/media/css/dataTables.responsive.css',
  ];
  public $js = [
    'js/plugins/datatables/media/js/jquery.dataTables.min.js',
    'js/plugins/datatables/media/js/dataTables.bootstrap.min.js',
    'js/plugins/datatables/media/js/dataTables.responsive.min.js',
    'js/tables-datatables.js',
  ];
  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
