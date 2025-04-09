<?php

namespace backend\controllers;

use aiur\repositories\PageRepository;
use aiur\services\PageService;
use backend\components\AccessController;

class PagesController extends AccessController
{
  private $repo;
  private $service;

  public function __construct( $id, $module, PageRepository $repo, PageService $service, array $config = [] )
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
        return $this->redirect(['pages/update', 'id' => $id]);

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
