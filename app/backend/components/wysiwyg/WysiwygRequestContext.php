<?php

namespace backend\components\wysiwyg;

use Symfony\Component\Filesystem\Exception\InvalidArgumentException;
use yii\helpers\Json;

class WysiwygRequestContext
{
    private array $folderTypes = [
        'image' => 'wysiwyg_imgs',
        'file' => 'wysiwyg_files',
    ];

    private string $context;
    private string $mode;
    private int $id;

    private function __construct(string $context, string $mode, int $id)
    {
        if(!in_array($mode, array_keys($this->folderTypes))) {
            throw new InvalidArgumentException('Wrong folder');
        }

        $this->context = $context;
        $this->mode = $mode;
        $this->id = $id;
    }

    public static function createFromParams($params) :self
    {
        $arr = Json::decode($params);

        return new self($arr['context'], $arr['mode'], (int) $arr['id']);
    }

    public function getFolderPath() :string
    {
        return \Yii::getAlias('@uploads/') . $this->folderTypes[$this->mode] . '/'. $this->getFolderName() . '/'. $this->id;
    }

    public function getFullPath($filename) :string
    {
        return $this->getFolderPath(). '/'. $filename;
    }

    public function getPublicUrl($filename) :string
    {
        return \Yii::getAlias('@upl/') . $this->folderTypes[$this->mode] . '/'. $this->getFolderName() . '/'. $this->id. '/'. $filename;
    }

    public function isImage() :bool
    {
        return $this->folderTypes[$this->mode] === 'wysiwyg_imgs';
    }

    public function getFolderName() :string
    {
        return strtolower(array_reverse(explode('\\', $this->context))[0]);
    }
}