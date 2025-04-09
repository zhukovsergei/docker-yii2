<?php
namespace frontend\controllers;

use aiur\repositories\UserRepository;
use common\models\Callback;
use frontend\components\FrontendController;

class SiteController extends FrontendController
{
    public function actionIndex()
    {
        //    throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        //    $m = new Callback();
        //    $m->name = 'Вася';
        //    $m->save();

        return $this->render('index');
    }

    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
        return false;
    }

}
