<?php
namespace console\controllers;

use common\models\Gallery;
use yii\console\Controller;
use yii\helpers\Console;

class StatsController extends Controller
{
  public function actionClear()
  {
    \Yii::$app->db->createCommand()->truncateTable('stats')->execute();
  }
}
