<?php
return yii\helpers\ArrayHelper::merge(
  require __DIR__ . '/../../common/config/test.php',
  require __DIR__ . '/main.php',
  [
    'id' => 'app-frontend-tests',
    'bootstrap' => new \yii\helpers\ReplaceArrayValue(['seo', 'log']),
    'components' => [
      'assetManager' => [
        'basePath' => __DIR__ . '/../../web/public/assets',
      ],
      'urlManager' => [
        'showScriptName' => true,
      ],
    ]
  ]
);