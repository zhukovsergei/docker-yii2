<?php
namespace backend\widgets;

use yii\base\Widget;
use common\models\Page;

class Sidebar extends Widget
{
  public function init()
  {
    parent::init();

  }
  public function run()
  {
    return $this->render('sidebar', [
      'pages' => Page::find()->all(),
    ]);
  }
}