<?php

use yii\web\AssetManager;

return [
    'id' => 'app-common',

    'name' => 'Common side application config',

    'timeZone' => 'Europe/Zurich',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@npm/bower-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',

    /*  'bootstrap' => [
        'common\bootstrap\SetUp'
      ],*/
    'components' => [

        'db' => require __DIR__ . '/db.php',
        'fs' => [
            'class' => 'creocoder\flysystem\LocalFilesystem',
            'path' => '@uploads',
        ],

        'assetManager' => [
            'class' => AssetManager::class,
            'bundles' => [
                yii\web\JqueryAsset::class => [
                    'js' => ['jquery.min.js'],
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD]
                ],
                yii\bootstrap\BootstrapAsset::class => [
                    'css' => ['css/bootstrap.min.css']
                ],
                yii\bootstrap\BootstrapPluginAsset::class => [
                    'js' => ['js/bootstrap.min.js']
                ]
            ],
        ],

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            /*'rules' => [
              ['class' => 'yii\rest\UrlRule', 'controller' => 'users'],
            ],*/
        ],

        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@app/messages',
                    //          'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],

        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'timeFormat' => 'H:mm',
            'datetimeFormat' => 'd.MM.yyyy H:mm',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CHF',
        ],

        'settings' => [
            'class' => pheme\settings\components\Settings::class,
            'modelClass' => common\models\Setting::class,
            'cache' => null
        ],

        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            'useFileTransport' => filter_var(getenv('EMAIL_FILE_TRANSPORT'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'viewPath' => '@common/mail',
        ],

        'cache' => [
            'class' => yii\caching\FileCache::class,
            //      'class' => 'yii\caching\MemCache',
            //      'useMemcached' => true,
        ],

    ],
];

