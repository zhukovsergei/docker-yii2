<?php
namespace backend\widgets\fields;

class Image extends ExtendWidget
{
    public $showLoadButton = true;
    public $width = 250;
    public $height = null;
    public $val = null;

    public $lg = [2, 3];

    public function run()
    {
        $imagePath = isset($this->model) ? $this->model->getUploadedFilePath($this->nf) : null;

        $fileUrl = isset($this->model) ? $this->model->getUploadedFileUrl($this->nf) : null;

        if(file_exists($imagePath)) {
            $thumbUrl = $this->model->getThumbFileUrl($this->nf);
        }

        return $this->render( 'image', [
            'lf' => $this->lf,
            'nf' => $this->nf,
            'hint' => $this->hint,
            'showLoadButton' => $this->showLoadButton,
            'val' => $this->val,
            'classModelName' => $this->model? get_class($this->model): null,
            'modelId' => $this->model->id ?? null,
            'lg' => $this->lg,
            'imagePath' => $imagePath,
            'fileUrl' => $fileUrl,
            'thumbUrl' => $thumbUrl ?? null,
        ]);
    }
}