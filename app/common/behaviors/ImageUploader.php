<?php

namespace common\behaviors;

use backend\components\FileCleaner;
use common\components\Adobe;
use common\components\SimpleImage;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class ImageUploader extends AttributeBehavior
{
  /*
      [
        'class' => ImageUploader::class,
        'attribute' => 'image',
        'size' => [
          'thumb' => 150
        ],
        'thumbs' => [
          'thumb' => [300],
        ],
      ],
*/

  public $attribute = 'image';
  public $thumbs = [];
  public $resize = true;
  public $size = [];

  public $path = '@uploads/';

  protected $file;

  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
    ];
  }

  public function beforeSave()
  {
    if($this->file = UploadedFile::getInstanceByName($this->attribute))
    {
      FileCleaner::remove($this->owner->{$this->attribute});

      $filename = Adobe::genName($this->file->getBaseName()).$this->file->getExtension();

      $path = \Yii::getAlias($this->path).$filename;

      $this->file->saveAs($path, empty($this->thumbs));

      if( exif_imagetype($path) && $this->resize )
      {
        $img = new SimpleImage($path);

        if(empty($this->size))
        {
          $img->best_fit(1280, 1280);
        }
        else
        {
          switch(key($this->size))
          {
            case 'height':
              $img->fit_to_height($this->size['height']);
              break;
            case 'thumb':
              if(is_array($this->size['thumb']))
              {
                list($with, $height) = $this->size['thumb'];
                $img->thumbnail($with, $height);
              }
              else
              {
                $img->thumbnail($this->size['thumb']);
              }
              break;
          }
        }

        $img->save($path);
      }

      $this->owner->{$this->attribute} = $filename;

      foreach($this->thumbs as $attribute => $values)
      {
        $filenameThumb = Adobe::genName($this->file->getBaseName()).$this->file->getExtension();
        $pathThumb = \Yii::getAlias($this->path).$filenameThumb;

        $this->file->saveAs($pathThumb, false);

        $img = new SimpleImage($pathThumb);

        switch(count($values))
        {
          case 1:
            $img->thumbnail($values[0]);
            break;

          case 2:
            $img->best_fit($values[0], $values[1]);
            break;
        }

        $img->save($pathThumb);

        $this->owner->{$attribute} = $filenameThumb;
      }

      UploadedFile::reset();
    }
  }
}