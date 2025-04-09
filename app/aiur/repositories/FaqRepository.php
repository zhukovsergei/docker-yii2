<?php

namespace aiur\repositories;

use common\models\Faq;
use yii\data\ActiveDataProvider;

class FaqRepository
{
  public function getAll(): array
  {
    $rows = Faq::find()->all();
    if ( empty($rows) )
    {
      throw new NotFoundException('Not found.');
    }

    return $rows;
  }

  public function get($id): Faq
  {
    $row = Faq::findOne($id);
    if ( empty($row) )
    {
      throw new NotFoundException('Not found.');
    }
    return $row;
  }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Faq::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(Faq $row)
  {
    if ( ! $row->save() )
    {
      throw new \RuntimeException('Saving error.');
    }
  }

  public function remove(Faq $row)
  {
    if ( ! $row->delete() )
    {
      throw new \RuntimeException('Removing error.');
    }
  }
}