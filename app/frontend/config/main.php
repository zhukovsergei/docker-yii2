<?php
$params = array_merge(
    require __DIR__.'/../../common/config/params.php',
    require __DIR__.'/params.php'
);

$config = [
    'id' => 'app-frontend',

    'name' => 'Project name',

    'basePath' => dirname(__DIR__),

    'bootstrap' => ['seo', 'log', 'userCounter'],

    'language' => 'de',

    'on beforeRequest' => static function ($event) {
        $lang = \Yii::$app->session->get('lang');
        if ($lang) {
            \Yii::$app->language = $lang;
        }
    },

    'controllerNamespace' => 'frontend\controllers',

    'components' => [

        'seo' => [
            'class' => \common\components\Seo::class
        ],

        'userCounter' => [
            'class' => frontend\components\UserCounter::class,
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tObyj990YYKKOAVibBsMOmxWTpuWyKzi',
        ],

        'urlManager' => [
            'class' => codemix\localeurls\UrlManager::class,
            'languages' => [
                'de' => 'de',
                'fr' => 'fr',
//                'it' => 'it',
//                'en' => 'en'
            ],
            'enableLanguagePersistence' => false,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                //        'page/<id:\d+>' => 'page/view',
                '<controller:[\w-]+>/<id:\d+>'=>'<controller>/view',
                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+>'=>'<controller>/<action>',
                '<slug:[\w-]+>' => 'page/view',
            ],
        ],

        'user' => [
            'identityClass' => common\models\User::class,
            'enableAutoLogin' => true,
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
            'errorAction' => 'site/error',
        ],

    ],

    'params' => $params,
];

/*if (YII_DEBUG) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['127.0.0.1', '::1']
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
  ];
}*/
return $config;