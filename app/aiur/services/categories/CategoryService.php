<?php

namespace aiur\services\categories;

use aiur\repositories\CategoryRepository;
use common\models\Categories;

class CategoryService
{
  private $repo;

  public function __construct( CategoryRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    if(empty($fd['parent_id']))
    {
      $c = new Categories();
      $c->name = $fd['name'];
      $c->makeRoot();
    }
    else
    {
      $parent = $this->repo->get($fd['parent_id']);
      $c = new Categories();
      $c->name = $fd['name'];

      $fd['prependTo'] ? $c->prependTo($parent) : $c->appendTo($parent);
    }

    return $c;
  }

  public function update($id, array $fd)
  {

    $current = Categories::findOne($id);
    $current->name = $fd['name'];
    $current->update();

    if($fd['parent_id'])
    {
      $parent = Categories::findOne($fd['parent_id']);

      if($fd['parent_id'] != $fd['old_parent_id'])
      {
        $fd['moveAsFirst'] ? $current->prependTo($parent) : $current->appendTo($parent);
      }
    }
  }
}