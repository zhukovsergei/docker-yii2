<?php

namespace common\tests\unit\models;

use common\models\Callback;

class CallbackTest extends \Codeception\Test\Unit
{

  public function testRowCreateDelete()
  {
    $m = new Callback();

    $m->date_add = '2017-08-13 17:08:24';
    $m->name = 'Василий';
    $m->phone = '+7 967 654 72 22';

    expect('Should fill', $m->date_add)->same('2017-08-13 17:08:24');
    expect('Should fill', $m->name)->same('Василий');
    expect('Should fill', $m->phone)->same('+7 967 654 72 22');

    expect('A row should saved', $m->save())->true();

    expect('A row should deleted', $m->delete())->greaterThan(0);
  }

}
