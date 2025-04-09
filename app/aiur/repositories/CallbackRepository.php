<?php

namespace aiur\repositories;


use common\models\Callback;
use yii\data\ActiveDataProvider;

class CallbackRepository
{
    public function getAll(): array
    {
      $rows = Callback::find()->all();
      if ( empty($rows) )
      {
        throw new NotFoundException('Not found.');
      }

      return $rows;
    }

    public function get($id): Callback
    {
      $row = Callback::findOne($id);
      if ( empty($row) )
      {
        throw new NotFoundException('Not found.');
      }
      return $row;
    }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => Callback::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

    public function save(Callback $row)
    {
      if ( ! $row->save() )
      {
        throw new \RuntimeException('Saving error.');
      }
    }

    public function remove(Callback $row)
    {
      if ( ! $row->delete() )
      {
        throw new \RuntimeException('Removing error.');
      }
    }
}