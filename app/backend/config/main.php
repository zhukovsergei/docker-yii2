<?php
$params = array_merge(
    require __DIR__.'/../../common/config/params.php',
    require __DIR__.'/params.php'
);

$config = [
    'id' => 'app-backend',

    'name' => 'Back-end side application config',

    'basePath' => dirname(__DIR__),

    'controllerNamespace' => 'backend\controllers',

    'bootstrap' => ['log'],

    'language' => 'de',

    'on beforeRequest' => static function ($event) {
        $lang = \Yii::$app->session->get('lang');
        if ($lang) {
            \Yii::$app->language = $lang;
        }
    },

    'modules' => [],

    'components' => [

        'userCounter' => [
            'class' => frontend\components\UserCounter::class,
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'v8RTR3DKOjWpbHjXHI9oRgmUHkFj9B6a',
            /*'parsers' => [
              'application/json' => 'yii\web\JsonParser',
            ]*/
        ],

        'user' => [
            'identityClass' => common\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login'],
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            //      'errorAction' => 'site/error',
        ],

    ],

    'params' => $params,
];

/*if (YII_DEBUG) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['*']
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
  ];
}*/
return $config;