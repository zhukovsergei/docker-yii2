<?php
namespace backend\widgets\fields;

class File extends ExtendWidget
{
    public $showLoadButton = true;
    public $width = 250;
    public $height = null;
    public $val = null;

    public $lg = [2, 3];

    public function run()
    {

        return $this->render( 'file', [
            'lf' => $this->lf,
            'nf' => $this->nf,
            'hint' => $this->hint,
            'showLoadButton' => $this->showLoadButton,
            'val' => $this->val,
            'classModelName' => $this->getClassModelName(),
            'modelId' => $this->modelId(),
            'lg' => $this->lg,
            'filePath' => $this->getFilePath(),
            'fileUrl' => $this->getFileUrl(),
        ]);
    }

    private function getFilePath() :string
    {
        return isset($this->model) ? $this->model->getUploadedFilePath($this->nf) : '';
    }

    private function getFileUrl() :string
    {
        return isset($this->model) ? $this->model->getUploadedFileUrl($this->nf) : '';
    }

    private function getClassModelName() :string
    {
        return $this->model? get_class($this->model) : '';
    }

    private function modelId() :string
    {
        return $this->model->id ?? '';
    }
}