<?php

namespace common\behaviors;

use DiDom\Document;
use Symfony\Component\Filesystem\Filesystem;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * To add wysiwyg-fields for filter, define it in the behaviors() method.
 *  [
 *   'class' => WysiwygFileCleaner::class,
 *     'attributes' => [
 *        'new_field',
 *     ],
 *   ],
 *
 * Class WysiwygFileCleaner
 * @package common\behaviors
 */
class WysiwygFileCleaner extends AttributeBehavior
{
    public string $attribute = 'long_text';
    private array $definedFields = [
        'content',
        'text_text',
        'long_text',
        'text',
    ];

    public Document $domService;
    public Filesystem $fileSystem;

    public function init()
    {
        $this->domService = new Document();
        $this->fileSystem = new Filesystem();
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'handle',
        ];
    }

    public function handle() :void
    {
        $existingFields = array_filter($this->definedFields + $this->attributes, function ($fieldName){
            return $this->owner->hasAttribute($fieldName) && $this->owner->isAttributeChanged($fieldName);
        });


        foreach ($existingFields as $field) {
            $this->findAndClearImages($field);
            $this->findAndClearFiles($field);
        }

    }

    private function findAndClearImages(string $attribute) :void
    {
        $this->domService->loadHtml($this->owner->getOldAttribute($attribute));

        $oldImageSources = [];
        foreach ($this->domService->find('img[src*=wysiwyg_imgs]') as $imgElement)
        {
            $oldImageSources[] = $imgElement->getAttribute('src');
        }

        if(empty($oldImageSources)) {
            return;
        }

        $this->domService->loadHtml($this->owner->{$attribute});

        $newImageSources = [];
        foreach ($this->domService->find('img[src*=wysiwyg_imgs]') as $imgElement)
        {
            $newImageSources[] = $imgElement->getAttribute('src');
        }

        $this->fileRemoveHandler($oldImageSources, $newImageSources, 'wysiwyg_imgs' );

    }

    private function findAndClearFiles(string $attribute) :void
    {
        $this->domService->loadHtml($this->owner->getOldAttribute($attribute));

        $oldFileSources = [];
        foreach ($this->domService->find('a[href*=wysiwyg_files]') as $fileElement)
        {
            $oldFileSources[] = $fileElement->getAttribute('href');
        }

        if(empty($oldFileSources)) {
            return;
        }

        $this->domService->loadHtml($this->owner->{$attribute});

        $newFileSources = [];
        foreach ($this->domService->find('a[href*=wysiwyg_files]') as $fileElement)
        {
            $newFileSources[] = $fileElement->getAttribute('href');
        }

        $this->fileRemoveHandler($oldFileSources, $newFileSources, 'wysiwyg_files' );
    }

    private function fileRemoveHandler(array $oldFileSources, array $newFileSources, string $folder) :void
    {

        $arrayDiff = array_diff($oldFileSources, $newFileSources);

        //we are search names of images only in the old source!
        $filesForRemove = array_intersect($oldFileSources, $arrayDiff);

        $pathsForRemove = [];
        foreach ($filesForRemove as $file)
        {
            $pathsForRemove[] = \Yii::getAlias("@uploads/") . $folder . '/'. explode($folder. '/', $file)[1];
        }

        $this->fileSystem->remove($pathsForRemove);
    }
}