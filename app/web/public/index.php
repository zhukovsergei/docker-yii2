<?php
//ini_set('display_errors', 1);

defined('YII_DEBUG') or define('YII_DEBUG', (boolean) strpos($_SERVER["HTTP_HOST"], 'dev'));
defined('YII_ENV') or define('YII_ENV', (boolean) strpos($_SERVER["HTTP_HOST"], 'dev') ? 'dev' : 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../../frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../frontend/config/main.php')
);

$application = new yii\web\Application($config);
$application->run();
