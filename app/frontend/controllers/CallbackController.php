<?php
namespace frontend\controllers;

use common\models\Callback;
use frontend\components\FrontendController;

class CallbackController extends FrontendController
{
    public function actionAdd()
    {
        if(\Yii::$app->request->isAjax)
        {
            $fd = \Yii::$app->request->post('fd');
            $m = new Callback();
            $m->attributes = $fd;
            $m->save();

            return $this->sendOk();
        }
        else
        {
            return $this->sendError();
        }
    }


}
