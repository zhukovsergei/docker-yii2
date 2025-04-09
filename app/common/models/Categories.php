<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\behaviors\ImageFileUploader\ImageUploadBehavior;
use common\traits\AssociateLabels;
use common\traits\ImagePathGenerator;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Categories extends ActiveRecord
{
    use AssociateLabels;
    use ImagePathGenerator;

    public const ROOT = true;

    public function behaviors() :array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['compressor' => function(\claviska\SimpleImage $si){
                        return $si->thumbnail(100,70);
                    }],
                ],
            ],
            [
                'class' => NotifyBehavior::class,
            ],
            [
                'class' => NestedSetsBehavior::class,
                //        'treeAttribute' => 'tree',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function getFullTree()
    {
        return Categories::findOne(['root' => self::ROOT])->children()->all();
    }

    public static function getRoots()
    {
        return Categories::findOne(['root' => Categories::ROOT])->children(1)->all();
    }

    public function getSortableItems()
    {
        $itemsSortableWidget = [];
        $descendants = $this->children(1)->all();
        foreach( $descendants as $descendant )
        {
            $itemsSortableWidget[] = [
                'content' => $descendant->name,
                'options' => ['data-id' => $descendant->id],
            ];
        }
        return $itemsSortableWidget;
    }

    public function getRootNode()
    {
        $root = $this;

        foreach($this->parents()->all() as $parent)
        {
            if($parent->depth === 1)
            {
                $root = $parent;
            }
        }

        return $root;
    }

    public function getIdsNestedCategories()
    {
        $ids = [$this->id];

        foreach($this->children()->all() as $child)
        {
            $ids[] = $child->id;
        }

        return $ids;
    }

    public function getIdsNestedProducts()
    {
        $ids = $this->getIdsNestedCategories();
        $rows = Products::find()->where(['category_id' => $ids])->orderBy('id DESC')->all();
        return ArrayHelper::getColumn($rows, 'id');
    }

    public static function getIdsNestedCategoriesById($id) :array
    {
        $ids = [$id];

        if($category = self::findOne($id))
        {
            foreach($category->children()->all() as $child)
            {
                $ids[] = $child->id;
            }
        }

        return $ids;
    }
}