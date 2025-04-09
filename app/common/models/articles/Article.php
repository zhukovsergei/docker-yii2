<?php

namespace common\models\articles;

use backend\components\NotifyBehavior;
use common\behaviors\ImageFileUploader\FileUploadBehavior;
use common\behaviors\ImageFileUploader\ImageUploadBehavior;
use common\behaviors\WysiwygFileCleaner;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Article extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

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
                'class' => MultilingualBehavior::class,
                'languages' => [
                    'de' => 'German',
                    'fr' => 'French',
//                    'it' => 'Italian',
//                    'en' => 'English',
                ],
                //'languageField' => 'language',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                'langClassName' => ArticleLang::class,
//                'defaultLanguage' => 'de',
                'langForeignKey' => 'owner_id',
                'tableName' => '{{%article_lang}}',
                'attributes' => [
                    'title', 'short_text', 'long_text', 'file'
                ]
            ],
/*            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'file'
            ],*/
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['compressor' => static function(\claviska\SimpleImage $si){
                        return $si->thumbnail(100,70);
                    }],
                    'blog-post-preview' => ['compressor' => static function(\claviska\SimpleImage $si){
                        return $si->thumbnail(500,300);
                    }],
                ],
            ],
            [
                'class' => NotifyBehavior::class,
            ]
        ];
    }

    public static function tableName() :string
    {
        return '{{%article}}';
    }

    public static function find()
    {
        return new MultilingualQuery(static::class);
    }
}