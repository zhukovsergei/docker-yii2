<?php
namespace backend\widgets;

use yii\base\Widget;

class Brand extends Widget
{
  public function init()
  {
    parent::init();

  }
  public function run()
  {

    return $this->render('brand');
  }
}