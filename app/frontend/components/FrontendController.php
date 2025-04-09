<?php
namespace frontend\components;

use common\controllers\BaseController;
use frontend\models\Stats;

class FrontendController extends BaseController
{

  public function init()
  {
    parent::init();

    $m = new Stats;
    $m->ip = \Yii::$app->request->userIP;
    $m->date = date('Y-m-d H:i:s');
    $m->save();
  }

}
