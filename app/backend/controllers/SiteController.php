<?php
namespace backend\controllers;

use aiur\services\LanguageService;
use backend\components\AccessController;
use common\models\Students;
use common\models\User;

class SiteController extends AccessController
{
    private $language;

    public function __construct( $id, $module, LanguageService $language, array $config = [] )
    {
        parent::__construct( $id, $module, $config );

        $this->language = $language;
    }
    public function actionTest()
    {
        $a = Students::findOne(2);
        $a->auditories = [
            ['id' => 2, 'name' => 'Втоаря'],
            ['id' => 8, 'name' => 'Третья'],
            ['name' => 'Новая'],
        ];
        $a->save();
    }

    public function actionIndex()
    {
        $sql = "SELECT IF(COUNT(ip) = 0, 1, COUNT(ip)) as hits, IF(COUNT(DISTINCT ip) = 0, 1, COUNT(DISTINCT ip)) as hosts FROM stats WHERE DATE(date) = DATE(NOW())";
        $res = \Yii::$app->db->createCommand($sql)->queryOne();

        /*
         * WIDGET "Базы данных"
         */
        $sql = "SELECT table_schema 'name',  Round(Sum(data_length + index_length) / 1024 / 1024, 1) 'size'
            FROM   information_schema.tables
            GROUP  BY table_schema";
        $resDBInfo = \Yii::$app->db->createCommand($sql)->queryAll();

        $usersQt = User::find()->count();
        $usersBanned = User::find()->where(['banned' => 1])->count();
        $usersAdmins = User::find()->where(['root' => 1])->count();

        return $this->render( 'index', [
            'hits' => $res['hits'],
            'hosts' => $res['hosts'],
            'resDBInfo' => $resDBInfo,
            'usersQt' => $usersQt,
            'usersBanned' => $usersBanned,
            'usersAdmins' => $usersAdmins,
        ]);
    }

    public function actionGetStats()
    {
        $sql = 'SELECT TIME_FORMAT(t.time,"%H:%i") as hour, COUNT(s.ip) as hits, COUNT(DISTINCT s.ip) as hosts
        FROM times as t
        LEFT JOIN
          stats as s
        ON HOUR(t.time) = HOUR(s.date) AND DATE(s.date) = DATE(NOW())
        WHERE HOUR(t.time) <= HOUR(NOW())
        GROUP BY t.time
        ORDER BY t.time';

        $results = \Yii::$app->db->createCommand($sql)->queryAll();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $results;
    }

    /**
     * Language switcher on CP navbar
     * @return \yii\console\Response|\yii\web\Response
     */
    public function actionChangeLang()
    {
        $lang = \Yii::$app->request->get('lang');

        $this->language->setLangApp($lang);

        return $this->getBack();
    }


    public function actionChangeLog()
    {
        return $this->render('versions');
    }
}
