<?php

namespace aiur\repositories;

use common\models\Review;
use yii\data\ActiveDataProvider;

class ReviewRepository
{
  public function getAll(): array
  {
    $rows = Review::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): Review
  {
    $row = Review::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Review::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(Review $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(Review $row)
  {
    if ( ! $row->delete() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}