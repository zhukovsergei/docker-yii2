<?php
namespace common\controllers;

use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{

  public function getBack()
  {
    return \Yii::$app->getResponse()->redirect(\Yii::$app->request->referrer);
  }

  public function getHome()
  {
    return \Yii::$app->getResponse()->redirect(\Yii::$app->homeUrl);
  }

  public function sendOk($msg = 'success')
  {
    \Yii::$app->response->format = Response::FORMAT_JSON;
    return [
      'success' => true,
      'msg' => $msg,
    ];
  }

  public function sendError($msg = 'error')
  {
    \Yii::$app->response->format = Response::FORMAT_JSON;
    return [
      'success' => false,
      'msg' => $msg,
    ];
  }

}
