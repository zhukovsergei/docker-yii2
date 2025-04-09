<?php

namespace backend\controllers;

use Yii;
use backend\components\AccessController;
use backend\components\GalleryFileUploader;
use common\models\Gallery;

class GalleryController extends AccessController
{
  public function actionIndex()
  {
    return $this->render( 'index' , [
      'images' => Gallery::find()->all(),
    ]);
  }

  public function actions()
  {
    return [
      'upload' => GalleryFileUploader::class
    ];
  }

  public function actionGetImgList()
  {
    return $this->renderPartial('ajaxList', array(
      'rows' => Gallery::find()->all(),
    ));
  }

/*  public function actionDelImg()
  {
    $fileID = Yii::$app->request->post('fileID');
    var_dump($fileID); exit;
    if($fileID) Gallery::findOne($fileID)->delete();

    return $this->sendOk();
  }*/
}
