<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Callback extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            [
                'class' => DateUpdater::class,
            ],
            [
                'class' => NotifyBehavior::class,
            ],
        ];
    }

    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'notify']);
    }

    public function notify($e)
    {
        \Yii::$app->mailer->compose('callback', ['m' => $e->sender])
                          ->setFrom([\Yii::$app->settings->get('main.supportNoReplyEmail') => \Yii::$app->settings->get('main.supportName')])
                          ->setTo(array_map('trim', explode(',', \Yii::$app->settings->get('main.emails'))))
                          ->setSubject('Callback for '. \Yii::$app->request->getHostInfo())
                          ->send();
    }
}