<?php

namespace common\behaviors\ImageFileUploader;

use claviska\SimpleImage;
use Codeception\Exception\ConfigurationException;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * Original Image
 * $news->getImageFileUrl('image')
 * $news->getImageFileUrl('image', '/images/empty.jpg')

 *  Thumbnail
 * $news->getThumbFileUrl('image')
 * $news->getThumbFileUrl('image', 'thumb')
 */
class ImageUploadBehavior extends FileUploadBehavior
{
  public $attribute = 'image';

  public $createThumbsOnSave = true;
  public $createThumbsOnRequest = true;

  public $thumbs = [];

  public $filePath = '@uploads/origin/[[model]]/[[attribute_id]]/[[basename]]';
  public $fileUrl = '@upl/origin/[[model]]/[[attribute_id]]/[[basename]]';

  public $thumbPath = '@uploads/cache/[[model]]/[[attribute_id]]/[[filename]]_[[profile]].[[extension]]';
  public $thumbUrl = '@upl/cache/[[model]]/[[attribute_id]]/[[filename]]_[[profile]].[[extension]]';

  /**
   * @inheritdoc
   */
  public function events()
  {
    return ArrayHelper::merge(parent::events(), [
      static::EVENT_AFTER_FILE_SAVE => 'afterFileSave',
    ]);
  }

  /**
   * @inheritdoc
   */
  public function cleanFiles()
  {
    parent::cleanFiles();
    foreach (array_keys($this->thumbs) as $profile) {
      @unlink($this->getThumbFilePath($this->attribute, $profile));
    }
  }

  /**
   * Resolves profile path for thumbnail profile.
   *
   * @param string $path
   * @param string $profile
   * @return string
   */
  public function resolveProfilePath($path, $profile)
  {
    $path = $this->resolvePath($path);
    return preg_replace_callback('|\[\[([\w\_/]+)\]\]|', function ($matches) use ($profile) {
      $name = $matches[1];
      switch ($name) {
        case 'profile':
          return $profile;
      }
      return '[[' . $name . ']]';
    }, $path);
  }

  /**
   * @param string $attribute
   * @param string $profile
   * @return string
   */
  public function getThumbFilePath($attribute, $profile = 'thumb')
  {
    $behavior = static::getInstance($this->owner, $attribute);
    return $behavior->resolveProfilePath($behavior->thumbPath, $profile);
  }

  /**
   *
   * @param string $attribute
   * @param string|null $emptyUrl
   * @return string|null
   */
  public function getImageFileUrl($attribute, $emptyUrl = null)
  {
    if (!$this->owner->{$attribute})
      return $emptyUrl;

    return $this->getUploadedFileUrl($attribute);
  }

  /**
   * @param string $attribute
   * @param string $profile
   * @param string|null $emptyUrl
   * @return string|null
   */
  public function getThumbFileUrl($attribute, $profile = 'thumb', $emptyUrl = null)
  {
    if (!$this->owner->{$attribute})
      return $emptyUrl;

    $behavior = static::getInstance($this->owner, $attribute);
    if ($behavior->createThumbsOnRequest)
      $behavior->createThumbs();
    return $behavior->resolveProfilePath($behavior->thumbUrl, $profile);
  }

  /**
   * After file save event handler.
   */
  public function afterFileSave()
  {
    if ($this->createThumbsOnSave == true)
      $this->createThumbs();

//      if ($this->resizeMain == true)
//        $this->createThumbs();
  }

  /**
   * Creates image thumbnails
   */
  public function createThumbs()
  {
    $path = $this->getUploadedFilePath($this->attribute);

    foreach ($this->thumbs as $profile => $config) {
      $thumbPath = static::getThumbFilePath($this->attribute, $profile);
      if (is_file($path) && !is_file($thumbPath)) {

        $thumb = new SimpleImage($path);
          if(empty($config['compressor']) || ! is_callable($config['compressor']))
          {
              throw new ConfigurationException('No compressor');
          }
        call_user_func($config['compressor'], $thumb);
        FileHelper::createDirectory(pathinfo($thumbPath, PATHINFO_DIRNAME), 0775, true);
        $thumb->toFile($thumbPath);
      }
    }
  }
}
