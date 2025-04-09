<?php
namespace backend\components;

use common\models\Gallery;
use common\models\ProductsImages;
use Yii;
use common\components\Adobe;
use common\components\SimpleImage;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;

class ProductFileUploader extends Action
{
  public $enableCsrfValidation = false;

  public function init()
  {
    parent::init();
  }

  public function run()
  {
    \Yii::$app->response->format = Response::FORMAT_JSON;

    $product_id = Yii::$app->request->post('product_id');

    if( $file = UploadedFile::getInstanceByName('file') )
    {
      $filenameThumb = Adobe::genName($file->getBaseName()).$file->getExtension();
      $filenameOrig = Adobe::genName($file->getBaseName()).$file->getExtension();

      $pathThumb = Yii::getAlias('@uploads/'.$filenameThumb);
      $pathOrig = Yii::getAlias('@uploads/'.$filenameOrig);

      $file->saveAs($pathThumb, false);
      $file->saveAs($pathOrig);

      $img = new SimpleImage($pathThumb);
      $img->thumbnail(150)->save($pathThumb);

      $img = new SimpleImage($pathOrig);
      $img->best_fit(1280, 768)->save($pathOrig);

      $m = new ProductsImages();
      $m->product_id = $product_id;
      $m->thumb = $filenameThumb;
      $m->image = $filenameOrig;
      $m->save();

      return [
        'success' => true
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
