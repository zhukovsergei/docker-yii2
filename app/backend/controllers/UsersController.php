<?php

namespace backend\controllers;

use aiur\forms\SignUpUserForm;
use aiur\forms\UserEditForm;
use aiur\repositories\UserRepository;
use aiur\services\UserService;
use yii\data\ActiveDataProvider;
use backend\components\AccessController;
use common\models\User;

class UsersController extends AccessController
{
  private $repo;
  private $service;

  public function __construct( $id, $module, UserRepository $repo, UserService $service, array $config = [] )
  {
    parent::__construct( $id, $module, $config );

    $this->repo = $repo;
    $this->service = $service;
  }

  public function actionIndex()
  {
    $dataProvider = $this->repo->getDataProvider();

    return $this->render('index' , [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionAdd()
  {
    if( \Yii::$app->request->isPost)
    {
      $form = new SignUpUserForm();
      if( $form->load(\Yii::$app->request->post(), 'fd') && $form->validate() )
      {
        $this->service->create($form);
      }
    }

    return $this->render('add');
  }

  public function actionUpdate($id)
  {
    if( \Yii::$app->request->isPost)
    {
      $user = $this->repo->get($id);
      $form = new UserEditForm($user);
      if( $form->load(\Yii::$app->request->post(), 'fd') && $form->validate() )
      {
        $this->service->update($user->id, $form);
      }
    }

    return $this->render('edit', [
      'row' => $this->repo->get($id),
    ]);
  }

  public function actionView($id)
  {
    $row = $this->repo->get($id);

    return $this->render( 'view' , [
      'row' => $row,
    ]);
  }

  public function actionDelete($id)
  {
    $row = $this->repo->get($id);
    $this->repo->remove($row);
  }

}
