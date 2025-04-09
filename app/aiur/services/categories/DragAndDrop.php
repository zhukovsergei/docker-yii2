<?php

namespace aiur\services\categories;

use aiur\repositories\CategoryRepository;

class DragAndDrop
{
  private $repo;

  public function __construct( CategoryRepository $repo )
  {
    $this->repo = $repo;
  }

  public function switcher( array $fd )
  {
    $current = $this->repo->get($fd['active_id']);

    if( ! empty($fd['prev_id']) )
    {
      $prev = $this->repo->get($fd['prev_id']);

      $current->insertAfter($prev);
    }
    elseif( ! empty($fd['next_id']) )
    {
      $next = $this->repo->get($fd['next_id']);
      $current->insertBefore($next);
    }
  }

}