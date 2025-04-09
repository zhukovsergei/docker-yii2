<?php

namespace aiur\services;

use aiur\repositories\FaqRepository;
use common\models\Faq;

class FaqService
{
  private $repo;

  public function __construct( FaqRepository $repo )
  {
    $this->repo = $repo;
  }

  public function create(array $fd)
  {
    $m = new Faq();
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