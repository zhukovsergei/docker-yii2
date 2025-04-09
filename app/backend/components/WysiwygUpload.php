<?php
namespace backend\components;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\InvalidArgumentException;
use Symfony\Component\Filesystem\Filesystem;
use Yii;
use common\components\SimpleImage;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;

class WysiwygUpload extends Action
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $filesystem = new Filesystem();

        $mode = (int) Yii::$app->request->post('mode');
        $file = UploadedFile::getInstanceByName('file');

        $folderTypes = [
            0 => 'wysiwyg_files',
            1 => 'wysiwyg_imgs',
        ];

        if(!isset($folderTypes[$mode])) {
            throw new InvalidArgumentException('Wrong folder');
        }

        if(!$file) {
            throw new FileNotFoundException('No file sent');
        }

        $filename = Uuid::uuid4(). '_' .$file->getBaseName() . '.' . $file->getExtension();

        $folderPath = Yii::getAlias('@uploads/') . $folderTypes[$mode];
        $fullPath = $folderPath . '/'. $filename;

        if(!$filesystem->exists($folderPath)) {
            $filesystem->mkdir($folderPath);
        }

        $file->saveAs($fullPath);

        if($folderTypes[$mode] === 'wysiwyg_imgs')
        {
            $img = new SimpleImage($fullPath);
            $img->best_fit(1280, 1280)->save($fullPath);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'filelink' => Yii::getAlias('@upl/') . $folderTypes[$mode] . '/'. $filename,
        ];
    }
}
