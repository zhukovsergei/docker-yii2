<?php

namespace aiur\services;

use aiur\repositories\DirectoryRepository;
use common\models\Directory;

class DirectoryService
{
  private $repo;

  public function __construct( DirectoryRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    $m = new Directory();
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