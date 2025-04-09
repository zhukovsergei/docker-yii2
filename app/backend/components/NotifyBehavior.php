<?php
namespace backend\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class NotifyBehavior extends Behavior
{
  public function events()
  {
    return [
      ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdateEvent',
      ActiveRecord::EVENT_AFTER_INSERT => 'afterInsertEvent',
      ActiveRecord::EVENT_AFTER_DELETE => 'afterDeleteEvent',
    ];
  }

  public function afterInsertEvent($event)
  {
    \Yii::$app->session->setFlash( 'msg', \Yii::t('app', 'The entry have created') );
  }

  public function afterUpdateEvent($event)
  {
    \Yii::$app->session->setFlash( 'msg', \Yii::t('app', 'The entry have updated') );
  }

  public function afterDeleteEvent($event)
  {
    \Yii::$app->session->setFlash( 'msg', \Yii::t('app', 'The entry have deleted') );
  }
}