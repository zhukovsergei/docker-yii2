<?php
namespace backend\widgets;

use yii\base\Widget;

class Header extends Widget
{
  public function init()
  {
    parent::init();

  }
  public function run()
  {

    return $this->render('header');
  }
}