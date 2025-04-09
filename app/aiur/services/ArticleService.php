<?php

namespace aiur\services;

use aiur\repositories\ArticlesRepository;
use common\models\articles\Article;

class ArticleService
{
  private $repo;

  public function __construct( ArticlesRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    $m = new Article();
    $m->attributes = $fd;
    $m->save();

    return $m;
  }

  public function update($id, array $fd)
  {
    $user = $this->repo->getWithLangById($id);
    $user->attributes = $fd;
    $user->update();
  }
}