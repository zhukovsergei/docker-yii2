<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\behaviors\ImageFileUploader\ImageUploadBehavior;
use common\behaviors\WysiwygFileCleaner;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use common\traits\ImagePathGenerator;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class News extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;
    use ImagePathGenerator;

    public function behaviors() :array
    {
        return [
            [
                'class' => DateUpdater::class,
            ],
            [
                'class' => WysiwygFileCleaner::class,
                'attributes' => [
                ],
            ],
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
            ]
        ];
    }
}