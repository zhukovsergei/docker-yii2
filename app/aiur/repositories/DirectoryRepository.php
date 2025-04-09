<?php

namespace aiur\repositories;

use common\models\Directory;
use yii\data\ActiveDataProvider;

class DirectoryRepository
{
  public function getAll(): array
  {
    $rows = Directory::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): Directory
  {
    $row = Directory::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Directory::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(Directory $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(Directory $row)
  {
    if ( ! $row->delete() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}