<?php

namespace aiur\services;

use aiur\repositories\NewsRepository;
use common\models\News;

class NewsService
{
  private $repo;

  public function __construct( NewsRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    $m = new News();
    $m->attributes = $fd;
    $m->save();

    return $m;
  }

  public function update($id, array $fd)
  {
    $user = $this->repo->get($id);
    $user->attributes = $fd;
    $user->update();
  }
}