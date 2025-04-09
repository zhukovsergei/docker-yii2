<?php

namespace backend\controllers;

use aiur\repositories\DirectoryRepository;
use aiur\services\DirectoryService;
use backend\components\AccessController;
use common\models\Auditory;
use common\models\Students;

class DirectoryController extends AccessController
{
  private $repo;
  private $service;

  public function __construct( $id, $module, DirectoryRepository $repo, DirectoryService $service, array $config = [] )
  {
    parent::__construct( $id, $module, $config );
    $this->repo = $repo;
    $this->service = $service;
  }

  public function actionIndex()
  {
    $dataProvider = $this->repo->getDataProvider();

    return $this->render( 'index', [
      'dataProvider' => $dataProvider,
    ] );
  }

  public function actionAdd()
  {
    if( \Yii::$app->request->isPost )
    {
      $fd = \Yii::$app->request->post( 'fd' );
      $this->service->create($fd);
    }

    return $this->render( 'add' );
  }

  public function actionUpdate( $id )
  {
    if( \Yii::$app->request->isPost )
    {
      $fd = \Yii::$app->request->post( 'fd' );
      $this->service->update($id, $fd);
    }

    return $this->render( 'edit', [
      'row' => $this->repo->get($id),
    ] );
  }

  public function actionDelete( $id )
  {
    $row = $this->repo->get($id);
    $this->repo->remove($row);
  }

}
