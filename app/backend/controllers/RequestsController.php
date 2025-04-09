<?php

namespace backend\controllers;

use aiur\repositories\RequestsRepository;
use backend\components\AccessController;

class RequestsController extends AccessController
{
  private $repo;

  public function __construct( $id, $module, RequestsRepository $repo, array $config = [] )
  {
    parent::__construct( $id, $module, $config );

    $this->repo = $repo;
  }

  public function actionIndex()
  {
    $dataProvider = $this->repo->getDataProvider();

    return $this->render( 'index', [
      'dataProvider' => $dataProvider,
    ] );
  }

  public function actionDelete( $id )
  {
    $row = $this->repo->get($id);
    $this->repo->remove($row);
  }

}
