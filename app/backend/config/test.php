<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/test.php',
    require __DIR__ . '/main.php',
    [
        'id' => 'app-backend-tests',
        'bootstrap' => new \yii\helpers\ReplaceArrayValue(['log']),
        'components' => [
            'assetManager' => [
                'basePath' => __DIR__ . '/../../web/assets',
            ],
            'urlManager' => [
                'showScriptName' => true,
            ],
        ]
    ]
);