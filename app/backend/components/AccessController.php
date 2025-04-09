<?php
namespace backend\components;

use common\models\User;
use yii\filters\AccessControl;

class AccessController extends BackendController
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            'allow' => true,
            'controllers' => ['auth'],
            'roles' => ['?'],
          ],
          [
            'allow' => true,
            'roles' => ['@'],
            'matchCallback' => function ($rule, $action) {
              return User::isUserAdmin(\Yii::$app->user->getIdentity()->email);
            }
          ]
        ]
      ],
    ];
  }}
