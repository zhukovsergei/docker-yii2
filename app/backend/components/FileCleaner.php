<?php
namespace backend\components;

use common\behaviors\ImageFileUploader\FileUploadBehavior;
use common\behaviors\ImageFileUploader\ImageUploadBehavior;
use yii\base\Action;
use yii\base\Exception;
use yii\db\ActiveRecord;

class FileCleaner extends Action
{
  public $enableCsrfValidation = false;

  public function run()
  {
    $classModelName = \Yii::$app->request->post('classModelName');
    $id = \Yii::$app->request->post('id');
    $field = \Yii::$app->request->post('field');

    $model = \Yii::createObject(['class' => $classModelName]);

    if($model instanceof ActiveRecord)
    {

      $row = $model->findOne($id);

      $behavior = static::getInstance($row, $field);
      $behavior->cleanFiles();

      $row->update();
    }
  }

  public static function getInstance(ActiveRecord $model, $attribute)
  {
    foreach ($model->behaviors as $behavior) {
      if (($behavior instanceof ImageUploadBehavior || $behavior instanceof FileUploadBehavior) && $behavior->attribute == $attribute)
      return $behavior;
    }
    return new Exception('Not found behavior');
  }

}
