<?php

namespace aiur\repositories;

use common\models\Page;
use yii\data\ActiveDataProvider;

class PageRepository
{
  public function getAll(): array
  {
    $rows = Page::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): Page
  {
    $row = Page::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Page::find(),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(Page $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(Page $row)
  {
    if ( ! $row->delete() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}