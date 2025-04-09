<?php
namespace backend\widgets\categories;

use common\models\Categories;
use yii\base\Widget;

class Tree extends Widget
{
  public function run()
  {
    return $this->render('tree',[
      'categories' => Categories::getFullTree(),
    ]);
  }
}