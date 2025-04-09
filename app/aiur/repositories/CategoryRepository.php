<?php

namespace aiur\repositories;

use common\models\Categories;
use yii\data\ActiveDataProvider;

class CategoryRepository
{
  public function getAll(): array
  {
    $rows = Categories::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): Categories
  {
    $row = Categories::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Categories::findOne(['root' => true])->children(),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(Categories $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(Categories $row)
  {
    if ( ! $row->deleteWithChildren() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}