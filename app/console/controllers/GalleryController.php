<?php
namespace console\controllers;

use common\models\Gallery;
use yii\console\Controller;
use yii\helpers\Console;

class GalleryController extends Controller
{
  public function actionClear()
  {
    $images = Gallery::find()->all();

    foreach($images as $img)
    {
      @unlink(\Yii::getAlias('@uploads/'.$img->name));
      echo 'Removed '. $img->name."\n";

      $img->delete();
    }

//    $this->stdout("Hello?\n", Console::UNDERLINE);

//    $name = $this->ansiFormat('Alex', Console::FG_GREEN);
//    echo "Hello, my name is $name.";
  }

}
