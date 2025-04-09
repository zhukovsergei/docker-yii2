<?php

namespace common\components;

use yii\web\Controller;

class Seo extends \aquy\seo\components\Seo {

  public function init()
  {
    \Yii::$app->on(Controller::EVENT_BEFORE_ACTION, [$this, '_meta_page']);
    \Yii::$app->on(Controller::EVENT_AFTER_ACTION, [$this, '_meta_init']);
  }
}