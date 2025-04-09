<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    [
        'id' => 'app-common-tests',
        'basePath' => dirname(__DIR__),
        'components' => [
            'db' => [
                'dsn' => 'mysql:host=localhost;dbname=subytoch_yii2admin_test',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'user' => [
                'class' => yii\web\User::class,
                'identityClass' => common\models\User::class,
            ],
        ],
    ]
);
