<?php

namespace backend\controllers;

use aiur\repositories\CategoryRepository;
use aiur\services\categories\CategoryService;
use aiur\services\categories\DragAndDrop;
use backend\components\AccessController;
use common\models\Categories;

class CategoriesController extends AccessController
{
  private $repo;
  private $service;
  private $dragAndDrop;

  public function __construct( $id, $module,
                               CategoryRepository $repo,
                               CategoryService $service,
                               DragAndDrop $dragAndDrop,
                               array $config = [] )
  {
    parent::__construct( $id, $module, $config );
    $this->repo = $repo;
    $this->service = $service;
    $this->dragAndDrop = $dragAndDrop;
  }

  public function actionIndex()
  {
    $dataProvider = $this->repo->getDataProvider();

    return $this->render( 'index' , [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionAdd()
  {
    if(\Yii::$app->request->isPost)
    {
      $fd = \Yii::$app->request->post('fd');
      $this->service->create($fd);
    }

    return $this->render('add', [
      'categories' => $this->repo->getAll(),
    ]);
  }

  public function actionUpdate($id)
  {
    if(\Yii::$app->request->isPost)
    {
      $fd = \Yii::$app->request->post('fd');
      $this->service->update($id, $fd);

      return $this->redirect(['index']);
    }

    return $this->render('edit', [
      'categories' => $this->repo->getAll(),
      'row' => $this->repo->get($id),
    ]);
  }

  public function actionDragAndDrop()
  {
    $fd = \Yii::$app->request->post('fd');

    $this->dragAndDrop->switcher($fd);

    return $this->sendOk();
  }

  public function actionGetHtmlTree()
  {
    return $this->renderPartial('htmlTree', [
      'categories' => Categories::getFullTree()
    ]);
  }

  public function actionDelTreeNode()
  {
    $id = \Yii::$app->request->post('id');
    $row = $this->repo->get($id);
    $this->repo->remove($row);
    return $this->sendOk();
  }

  public function actionDelete( $id )
  {
    $row = $this->repo->get($id);
    $this->repo->remove($row);
  }

}
