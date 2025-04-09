<?php

namespace backend\controllers;

use common\components\Adobe;
use common\models\File;
use backend\components\AccessController;
use backend\models\Settings;
use yii\web\UploadedFile;

class SettingsController extends AccessController
{
  public function actionIndex()
  {
    $file = File::findOne(['extra' => 'price']);

    return $this->render( 'index' , [
      'rows' => Settings::find()->all(),
      'file' => $file,
    ]);
  }

  public function actionEdit()
  {
    $fd = \Yii::$app->request->post('fd');

    switch($fd['type'])
    {
      case $fd['type'] == 'integer' :
        $fd['value'] = (isset($fd['value']) AND !empty($fd['value'])) ? (int)$fd['value'] : 0;
        break;

      case $fd['type'] == 'boolean' :
        $fd['value'] = isset($fd['boolean']) ? true : false;
        break;
    }

    \Yii::$app->settings->set($fd['sectionKey'], $fd['value']);
//    \Yii::$app->settings->clearCache();

    return $this->getBack();
  }

  public function actionLoadStaticFile()
  {
    if( $file = UploadedFile::getInstanceByName('file') )
    {
      $filename = Adobe::genName($file->getBaseName()).$file->getExtension();
      File::updateAll(['name' => $filename], 'extra = :extra', [':extra' => 'price']);

      $path = \Yii::getAlias('@uploads/').$filename;

      $file->saveAs($path);
    }

    return $this->getBack();
  }


}
