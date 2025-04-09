<?php

namespace common\tests\unit\models;

use common\models\articles\Article;

class ArticleTest extends \Codeception\Test\Unit
{

  public function testRowCreateDelete()
  {
    $m = new Article();

    $m->date_add = '2017-08-13 17:08:24';
    $m->date_pub = '2017-08-29';
    $m->title = 'Pretty title';
    $m->short_text = 'Short Text';
    $m->long_text = 'Long text';
    $m->approve = 1;

    expect('Should fill', $m->date_add)->same('2017-08-13 17:08:24');
    expect('Should fill', $m->date_pub)->same('2017-08-29');
    expect('Should fill', $m->title)->same('Pretty title');
    expect('Should fill', $m->short_text)->same('Short Text');
    expect('Should fill', $m->long_text)->same('Long text');
    expect('Should fill', $m->approve)->same(1);

    expect('A row should saved', $m->save())->true();

    expect('A row should deleted', $m->delete())->greaterThan(0);
  }

}
