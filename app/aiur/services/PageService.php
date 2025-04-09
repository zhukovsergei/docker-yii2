<?php

namespace aiur\services;

use aiur\repositories\PageRepository;
use common\models\Page;

class PageService
{
  private $repo;

  public function __construct( PageRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    $m = new Page();
    $m->attributes = $fd;
    $m->save();

    return $m;
  }

  public function update($id, array $fd)
  {
    $user = $this->repo->get($id);
    $user->attributes = $fd;
    $user->save();
  }
}