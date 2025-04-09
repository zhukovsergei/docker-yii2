<?php

namespace aiur\repositories;

use common\models\User;
use yii\data\ActiveDataProvider;

class UserRepository
{
    public function getAll(): array
    {
      $rows = User::find()->all();
      if ( empty($rows) )
      {
        throw new NotFoundException('Not found.');
      }

      return $rows;
    }

    public function get($id): User
    {
        $row = User::findOne($id);
        if ( empty($row) )
        {
            throw new NotFoundException('Not found.');
        }
        return $row;
    }

    public function getByUsername($username): User
    {
        $row = User::find()->where(['username' => $username])->one();
        if ( empty($row) )
        {
            throw new NotFoundException('Not found.');
        }
        return $row;
    }

  public function getDataProvider(): ActiveDataProvider
  {
    return new ActiveDataProvider([
      'query' => User::find()->orderBy('id DESC'),
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);
  }

  public function save(User $row)
    {
      if ( ! $row->save() )
      {
        throw new \RuntimeException('Saving error.');
      }
    }

    public function remove(User $row)
    {
      if ( ! $row->delete() )
      {
        throw new \RuntimeException('Removing error.');
      }
    }
}