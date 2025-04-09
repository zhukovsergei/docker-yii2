<?php
namespace frontend\controllers;

use common\models\articles\Article;
use frontend\components\FrontendController;

class ArticleController extends FrontendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'row' => Article::findOne($id),
        ]);
    }

}
