<?php
namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
  public function actionInit()
  {
    $auth = \Yii::$app->authManager;

    // add "createPost" permission
//    $createPost = $auth->createPermission('dashboard');
//    $createPost->description = 'Read the Admin Dashboard';
//    $auth->add($createPost);


    $adminRole = $auth->createRole('root');
    $auth->add($adminRole);

//    $auth->assign($author, 2);
    $auth->assign($adminRole, 1);
  }

}