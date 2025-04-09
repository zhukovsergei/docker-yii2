<?php
namespace backend\widgets\categories;

use common\models\Categories;
use yii\base\Widget;

class Sortable extends Widget
{
  public $category_id = 1;

  public function run()
  {
    $root = Categories::findOne($this->category_id);

    return $this->render('sortable',[
      'itemsSortableWidget' => $root->getSortableItems(),
    ]);
  }
}