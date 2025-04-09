<?php
namespace console\controllers;

use common\models\Gallery;
use DateTime;
use DateTimeZone;
use yii\console\Controller;
use yii\helpers\Console;

class TestController extends Controller
{
  public function actionIndex()
  {
    /*for($i = 64800; $i <= 144000;  $i+=3600)
    {
      var_dump(date('H:i:s', $i));
    }*/

    $datetime = new DateTime('today', new DateTimeZone('Europe/London'));
    for($i = 0; $i < 24; $i++)
    {
      var_dump($datetime->format('H:i:s'));
      $datetime->modify('+1 hour');
    }

//    $this->stdout("Hello?\n", Console::UNDERLINE);

//    $name = $this->ansiFormat('Alex', Console::FG_GREEN);
//    echo "Hello, my name is $name.";
  }

}
