<?php

namespace aiur\repositories;

use common\models\articles\Article;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class ArticlesRepository
{
    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['date_pub' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                    ],
                    'date_pub' => [
                        'asc' => ['date_pub' => SORT_ASC],
                        'desc' => ['date_pub' => SORT_DESC],
                    ],
                    'page_id' => [
                        'asc' => ['page_id' => SORT_ASC],
                        'desc' => ['page_id' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageParam' => 'page-article',
                'pageSizeParam' => 'per-page-article',
                'pageSize' => 20,
//                'pageSizeLimit' => [1, 5],
            ]
        ]);
    }

    public function getAll(): DataProviderInterface
    {
        $query = Article::find();
        return $this->getProvider($query);
    }

    public function getAllPublished(): DataProviderInterface
    {
        $query = Article::find()->where(['approve' => 1]);
        return $this->getProvider($query);
    }

    public function get($id): Article
    {
        $row = Article::findOne($id);
        if ($row === null)
        {
            throw new NotFoundException('Not found.');
        }
        return $row;
    }

    public function getWithLangById($id)
    {
        $row = Article::find()->multilingual()->where(['id' => $id])->one();
        if ($row === null) {
            throw new NotFoundException('Not found.');
        }
        return $row;
    }

    public function findLastAll(): array
    {
        return Article::find()->where(['approve' => 1])->orderBy(['date_pub' => SORT_DESC])->all();
    }

    public function getDataProvider(): ActiveDataProvider
    {
        return $this->getProvider(Article::find());
    }

    public function save(Article $row)
    {
        if ( ! $row->save() )
        {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Article $row)
    {
        if ( ! $row->delete() )
        {
            throw new \RuntimeException('Removing error.');
        }
    }
}