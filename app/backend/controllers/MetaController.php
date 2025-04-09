<?php

namespace backend\controllers;

use aquy\seo\module\models\SeoMeta;
use aquy\seo\module\models\SeoPage;
use backend\components\AccessController;
use yii\data\ActiveDataProvider;

class MetaController extends AccessController
{
  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => SeoPage::find()->with(array_keys(SeoMeta::nameList())),
      'pagination' => [
        'pageSize' => 100
      ],
    ]);

    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionUpdate( $id )
  {
    if( \Yii::$app->request->isPost )
    {
      $fd = \Yii::$app->request->post( 'fd' );

      foreach($fd as $key => $val)
      {
        $row = SeoMeta::find()->where( ['page_id' => $id, 'name' => $key] )->one();

        if( empty($row) )
        {
          $m = new SeoMeta();
          $m->page_id = $id;
          $m->name = $key;
          $m->content = $val;
          $m->save(false);
        }
        else
        {
          $row->content = $val;
          $row->update();
        }
      }
    }

    return $this->render( 'edit', [
      'rows' => SeoMeta::find()->where(['page_id' => $id])->asArray()->all()
    ] );
  }

  public function actionDelete( $id )
  {
    SeoPage::findOne($id)->delete();
  }

}
