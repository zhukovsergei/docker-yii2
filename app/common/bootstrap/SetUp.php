<?php
/**
 * Created by PhpStorm.
 * User: Adobe
 * Date: 02.07.2017
 * Time: 5:03
 */

namespace common\bootstrap;

use aiur\repositories\UserRepository;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
  public function bootstrap($app)
  {
    $container = \Yii::$container;

//    \common\components\VarDumper::dump($app); exit;
//    $container->setSingleton(UserRepository::class);
/*    $container->setSingleton(SimpleEventDispatcher::class, function (Container $container) {
      return new SimpleEventDispatcher($container, [
        UserSignUpRequested::class => [UserSignupRequestedListener::class],
//        UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],

      ]);
    });*/

  }

}