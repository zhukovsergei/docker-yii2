<?php

namespace common\models;

use common\traits\FreeRules;
use yii\data\ActiveDataProvider;

class ProductsSearch extends Products
{
    use FreeRules;

    public static function tableName()
    {
        return 'products';
    }

    public function search($params)
    {
        $q = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $q,
        ]);

        $q->joinWith(['category']);

        if (!$this->load($params)) {
            return $dataProvider;
        }

        $q->andFilterWhere([self::tableName().'.'.'id' => $this->id]);
        $except = ['id', 'category_id'];
        foreach(self::getTableSchema()->columns as $column)
        {
            if(in_array($column->name, $except)) continue;
            $q->andFilterWhere(['like', self::tableName().'.'.$column->name, $this->{$column->name}]);
        }
        $q->andFilterWhere(['like', 'categories.name', $this->category_id]);

        return $dataProvider;
    }}