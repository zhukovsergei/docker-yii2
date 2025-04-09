<?php
namespace backend\components;

use common\models\Gallery;
use Yii;
use common\components\Adobe;
use common\components\SimpleImage;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;

class GalleryFileUploader extends Action
{
  public $enableCsrfValidation = false;

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    \Yii::$app->response->format = Response::FORMAT_JSON;

    if( $file = UploadedFile::getInstanceByName('file') )
    {
      $filenameOrig = Adobe::genName($file->getBaseName()).$file->getExtension();

      $path = Yii::getAlias('@uploads/'.$filenameOrig);

      $file->saveAs($path);

      $img = new SimpleImage($path);
      $img->best_fit(1280, 768)->save($path);

      $m = new Gallery();
      $m->name = $filenameOrig;
      $m->save();

      return [
        'success' => true,
        'fileID' => $m->id,
      ];
    }
    else
    {
      return [
        'success' => false
      ];
    }
  }
}
