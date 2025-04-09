<?php
namespace common\behaviors\ImageFileUploader;

use Yii;
use yii\base\Exception;
use yii\base\InvalidCallException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * $news->getUploadedFileUrl('file')
 */
class FileUploadBehavior extends \yii\base\Behavior
{
  const EVENT_AFTER_FILE_SAVE = 'afterFileSave';

  public $createThumbsOnRequest = false;

  public $attribute = 'file';
  public $filePath = '@uploads/origin/[[model]]/[[attribute_id]]/[[basename]]';
  public $fileUrl = '@upl/origin/[[model]]/[[attribute_id]]/[[basename]]';

  /** @var \yii\web\UploadedFile */
  protected $file;

  /**
   * @inheritdoc
   */
  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
      ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
      ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
      ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
      ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
    ];
  }

  /**
   * Before validate event.
   */
  public function beforeValidate()
  {
    if ($this->owner->{$this->attribute} instanceof UploadedFile) {
      $this->file = $this->owner->{$this->attribute};
      return;
    }
    $this->file = UploadedFile::getInstance($this->owner, $this->attribute);

    if (empty($this->file)) {
      $this->file = UploadedFile::getInstanceByName($this->attribute);
    }

    if ($this->file instanceof UploadedFile) {
      $this->owner->{$this->attribute} = $this->file;
    }
  }

  /**
   * Before save event.
   *
   * @throws \yii\base\InvalidConfigException
   */
  public function beforeSave()
  {
    if ($this->file instanceof UploadedFile) {
      if (!$this->owner->isNewRecord) {
        /** @var ActiveRecord $oldModel */
        $oldModel = $this->owner->findOne($this->owner->primaryKey);
        $behavior = static::getInstance($oldModel, $this->attribute);
        $behavior->cleanFiles();
      }
      $this->owner->{$this->attribute} = $this->file->baseName . '.' . $this->file->extension;
    } else { // Fix html forms bug, when we have empty file field
      if (!$this->owner->isNewRecord && empty($this->owner->{$this->attribute}))
        $this->owner->{$this->attribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->attribute, null);
    }
  }

  /**
   * Removes files associated with attribute
   */
  public function cleanFiles()
  {
    $path = $this->resolvePath($this->filePath);
    @unlink($path);
  }

  /**
   * Replaces all placeholders in path variable with corresponding values
   *
   * @param string $path
   * @return string
   */
  public function resolvePath($path)
  {
    $path = Yii::getAlias($path);

    $pi = pathinfo($this->owner->{$this->attribute});
    $fileName = ArrayHelper::getValue($pi, 'filename');
    $extension = strtolower(ArrayHelper::getValue($pi, 'extension'));

    return preg_replace_callback('|\[\[([\w\_/]+)\]\]|', function ($matches) use ($fileName, $extension) {
      $name = $matches[1];
      switch ($name) {
        case 'hash':
          return substr(md5(microtime()), 0, 4);
        case 'extension':
          return $extension;
        case 'filename':
          return $fileName;
        case 'basename':
          return  $fileName . '.' . $extension;
        case 'model':
          $r = new \ReflectionClass($this->owner->className());
          return lcfirst($r->getShortName());
        case 'attribute':
          return lcfirst($this->attribute);
        case 'id':
        case 'pk':
          $pk = implode('_', $this->owner->getPrimaryKey(true));
          return lcfirst($pk);
        case 'id_path':
          return static::makeIdPath($this->owner->getPrimaryKey());

      }
      if (preg_match('|^attribute_(\w+)$|', $name, $am)) {
        $attribute = $am[1];
        return $this->owner->{$attribute};
      }
      if (preg_match('|^md5_attribute_(\w+)$|', $name, $am)) {
        $attribute = $am[1];
        return md5($this->owner->{$attribute});
      }
      return '[[' . $name . ']]';
    }, $path);
  }

  /**
   * @param integer $id
   * @return string
   */
  protected static function makeIdPath($id)
  {
    $id = is_array($id) ? implode('', $id) : $id;
    $length = 10;
    $id = str_pad($id, $length, '0', STR_PAD_RIGHT);

    $result = [];
    for ($i = 0; $i < $length; $i++)
      $result[] = substr($id, $i, 1);

    return implode('/', $result);
  }

  /**
   * After save event.
   */
  public function afterSave()
  {
    if ($this->file instanceof UploadedFile) {
      $path = $this->getUploadedFilePath($this->attribute);
      FileHelper::createDirectory(pathinfo($path, PATHINFO_DIRNAME), 0775, true);
      if (!$this->file->saveAs($path)) {
        throw new Exception('File saving error.');
      }
      $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
    }
  }

  /**
   * Returns file path for attribute.
   *
   * @param string $attribute
   * @return string
   */
  public function getUploadedFilePath($attribute)
  {
    $behavior = static::getInstance($this->owner, $attribute);
    if (!$this->owner->{$attribute})
      return '';
    return $behavior->resolvePath($behavior->filePath);
  }

  /**
   * Returns behavior instance for specified class and attribute
   *
   * @param ActiveRecord $model
   * @param string $attribute
   * @return static
   */
  public static function getInstance(ActiveRecord $model, $attribute)
  {
    foreach ($model->behaviors as $behavior) {
      if ($behavior instanceof self && $behavior->attribute == $attribute)
        return $behavior;
    }

    throw new InvalidCallException('Missing behavior for attribute ' . VarDumper::dumpAsString($attribute));
  }

  /**
   * Before delete event.
   */
  public function beforeDelete()
  {
    $this->cleanFiles();
  }

  /**
   * Returns file url for the attribute.
   *
   * @param string $attribute
   * @return string|null
   */
  public function getUploadedFileUrl($attribute)
  {
    if (!$this->owner->{$attribute})
      return null;

    $behavior = static::getInstance($this->owner, $attribute);
    return $behavior->resolvePath($behavior->fileUrl);
  }
}
