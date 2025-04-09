<?php

$dotenv = Dotenv\Dotenv::create(dirname(__DIR__,2));
$dotenv->load();

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@api', dirname(__DIR__, 2) . '/api');
Yii::setAlias('@frontend', dirname(__DIR__, 2) . '/frontend');
Yii::setAlias('@backend', dirname(__DIR__, 2) . '/backend');
Yii::setAlias('@console', dirname(__DIR__, 2) . '/console');
Yii::setAlias('@uploads', dirname(__DIR__, 2) . '/web/public/uploads');
Yii::setAlias('@aiur', dirname(__DIR__, 2) . '/aiur');