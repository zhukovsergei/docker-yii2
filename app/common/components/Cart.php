<?php
namespace common\components;


class Cart
{
  public static function addItem($id, $count = 1)
  {
    if(!$count) $count = 1;
    $bucket = \Yii::$app->session->get('bucket', []);

    $id = (int)$id; $count = (int)$count;
    $bucket[$id] = isset($bucket[$id]) ? $bucket[$id] + $count : $count;

    \Yii::$app->session->set('bucket', $bucket);
  }

  public static function changeItem($id, $count = 1)
  {
    if(!$count) $count = 1;
    $bucket = \Yii::$app->session->get('bucket', []);
    $bucket[$id] = $count;
    \Yii::$app->session->set('bucket', $bucket);
  }

  public static function delItem($id)
  {
    $bucket = \Yii::$app->session->get('bucket', []);
    unset($bucket[$id]);
    \Yii::$app->session->set('bucket', $bucket);
  }

  public static function getCount()
  {
    return count(\Yii::$app->session->get('bucket', []));
  }

  public static function getBucket()
  {
    return \Yii::$app->session->get('bucket', []);
  }

  public static function clear()
  {
    return \Yii::$app->session->remove('bucket');
  }

}