<?php
namespace backend\components\wysiwyg;

use common\components\SimpleImage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;

class WysiwygUploadImproved extends Action
{
    private Filesystem $fileSystemService;

    public function init()
    {
        $this->fileSystemService = new Filesystem();
        parent::init();
    }

    public function run() :array
    {
        $params = \Yii::$app->request->post('params');

        $wrc = WysiwygRequestContext::createFromParams($params);

        $files = UploadedFile::getInstancesByName('file');

        if(!$files) {
            throw new FileNotFoundException('No file sent');
        }

        $filesNames = [];
        foreach ($files as $file) {
            $hash = Uuid::uuid4();
            $savedFileInfo = $this->saveFileOnDisk($file, $hash, $wrc);

            $filesNames['file_'.$hash] = $savedFileInfo;
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        return $filesNames;
    }

    private function saveFileOnDisk($file, $hash, WysiwygRequestContext $wrc) :array
    {
        $filename = $file->getBaseName() . '.' . $file->getExtension();
        $hashedFilename = $hash. '_' .$filename;

        $folderPath = $wrc->getFolderPath();
        $fullPath = $wrc->getFullPath($hashedFilename);

        if(!$this->fileSystemService->exists($folderPath)) {
            $this->fileSystemService->mkdir($folderPath);
        }

        $file->saveAs($fullPath);

        if($wrc->isImage())
        {
            $img = new SimpleImage($fullPath);
            $img->best_fit(1280, 1280)->save($fullPath);
        }

        return [
            'url' => $wrc->getPublicUrl($hashedFilename),
            'name' => $filename,
            'id' => $hash,
        ];
    }
}
