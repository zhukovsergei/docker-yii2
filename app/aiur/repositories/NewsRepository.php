<?php

namespace aiur\repositories;

use common\models\News;
use yii\data\ActiveDataProvider;

class NewsRepository
{
  public function getAll(): array
  {
    $rows = News::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): News
  {
    $row = News::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => News::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(News $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(News $row)
  {
    if ( ! $row->delete() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}