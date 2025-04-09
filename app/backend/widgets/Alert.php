<?php
namespace backend\widgets;

use yii\base\Widget;

class Alert extends Widget
{

  public function init()
  {
    parent::init();

  }
  public function run()
  {
    if(\Yii::$app->session->hasFlash('msg'))
    {
      return $this->render('alert');
    }

    return null;
  }
}