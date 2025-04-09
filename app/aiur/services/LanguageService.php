<?php

namespace aiur\services;

use aiur\repositories\ArticlesRepository;
use common\models\articles\Article;

class LanguageService
{
  public function setLangApp($lang) :void
  {
      if(\in_array($lang, ['de', 'fr', 'it', 'en'])) {
          \Yii::$app->session->set('lang', $lang);
      }
  }
}