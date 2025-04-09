<?php
namespace backend\controllers;

use aiur\forms\AdminLoginForm;
use backend\components\AccessController;
use common\models\User;

class AuthController extends AccessController
{
  public $layout = 'auth';
  public $enableCsrfValidation = false;

  public function actionIndex()
  {
    $noAccounts = User::find()->count();

    return $this->render('index', [
      'noAccounts' => $noAccounts,
    ]);
  }

    public function actionLogin()
    {
        $fd = \Yii::$app->request->post('fd');

        if(!empty($fd['email']) && !empty($fd['password']) && !empty($user = User::findByEmail($fd['email']))
           && $user->validatePassword($fd['password']) && User::isUserAdmin($user->email))
        {
            \Yii::$app->user->login($user, isset($fd['remember']) ? 3600*24*7: 0);
            \Yii::$app->session->setFlash('msg', 'Successful authorization');
            return $this->goHome();
        }

        return $this->redirect(['index']);
    }

  public function actionGenFirstAccount()
  {
    $email = \Yii::$app->request->post('email');

    if(\Yii::$app->request->isAjax)
    {
      $password = \Yii::$app->security->generateRandomString(8);
      $m = new User();
      $m->username = 'Administrator';
      $m->auth_key = \Yii::$app->security->generateRandomString();
      $m->password_hash = \Yii::$app->security->generatePasswordHash($password);
      $m->email = $email;
      $m->root = 1;
      $m->save();

      \Yii::$app->mailer->compose('genFirstAccount', ['password' => $password])
        ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->params['supportName']])
        ->setTo($m->email)
        ->setSubject('New account for '.$_SERVER["HTTP_HOST"])
        ->send();
    }
  }

  public function actionLogout()
  {
    \Yii::$app->user->logout();
    return $this->redirect('/auth');
  }
}
