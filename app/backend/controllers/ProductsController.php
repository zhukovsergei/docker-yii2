<?php

namespace backend\controllers;

use common\models\ProductsSearch;
use backend\components\AccessController;
use backend\components\ProductFileUploader;
use common\models\Categories;
use common\models\Products;
use common\models\ProductsImages;
use yii\helpers\Url;

class ProductsController extends AccessController
{
  public function actions()
  {
    return array_merge(
      parent::actions(),
      [
        'upload' => ProductFileUploader::class
      ]);
  }

  public function actionIndex()
  {
    $searchModel = new ProductsSearch();

    $dataProvider = $searchModel->search(\Yii::$app->request->get());

    /*$dataProvider = new ActiveDataProvider([
      'query' => Products::find(),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);*/

//    $models = $provider->getModels(); //array of objects


    return $this->render('index' , [
      'dataProvider' => $dataProvider,
      'searchModel' => $searchModel,
    ]);
  }

  public function actionAdd()
  {
    if(\Yii::$app->request->isPost)
    {
      $fd = \Yii::$app->request->post('fd');

      $m = new Products();
      $m->attributes = $fd;
      $m->save();

      return $this->redirect(['update', 'id' => $m->id]);
    }

    return $this->render('add');
  }

  public function actionUpdate($id)
  {
    if(\Yii::$app->request->isPost)
    {
      $fd = \Yii::$app->request->post('fd');

      $row = Products::findOne($id);
      $row->attributes = $fd;
      $row->update();
    }

    return $this->render('edit', [
      'row' => Products::findOne($id),
      'categories' => Categories::getFullTree(),
    ]);
  }

  public function actionView($id)
  {
    return $this->render('view', [
      'row' => Products::findOne($id),
      'categories' => Categories::getFullTree(),
    ]);
  }

  public function actionGetImgList()
  {
    $product_id = \Yii::$app->request->get('id');

    return $this->renderPartial('ajaxList', array(
      'rows' => ProductsImages::findAll(['product_id' => $product_id]),
    ));
  }

  public function actionDelImg()
  {
    $id = \Yii::$app->request->post('id');

    ProductsImages::deleteAll(['id' => $id]);
    return $this->sendOk();
  }

  public function actionDelete()
  {
    $id = \Yii::$app->request->get('id');

    Products::findOne($id)->delete();

    \Yii::$app->session->setFlash('msg', 'Запись успешно удалена');

    return $this->getBack();
  }

}
