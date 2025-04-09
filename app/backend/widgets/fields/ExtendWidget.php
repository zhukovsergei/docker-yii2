<?php

namespace backend\widgets\fields;

use yii\base\Widget;

abstract class ExtendWidget extends Widget
{
    public $model;
    public $lf;
    public $nf;
    public $val;
    public $hint;

    public function beforeRun()
    {
        if (!parent::beforeRun()) {
            return false;
        }

        if (empty($this->lf)) {
            throw new \UnexpectedValueException('Label field must be exists');
        }

        if (empty($this->nf)) {
            throw new \UnexpectedValueException('Name field must be exists');
        }

        /**
         * if the source value is null we are to to get a value dynamically from a fieldname
         * fd[title] will be taken $model->title
         */
        if (\Yii::$app->controller->action->id === 'update' && is_null($this->val)) {
            if (empty($this->model)) {
                throw new \UnexpectedValueException('Model is empty');
            }

            $this->val = $this->getPossibleValue();
        }

        return true;
    }

    private function getPossibleValue()
    {
        if (isset($this->model->{$this->nf})) {
            return $this->model->{$this->nf};
        }

        if ($parsedFieldname = $this->getParsedFieldname()) {
            return $this->model->{$parsedFieldname};
        }

        return null;
    }

    /**
     * Extract field name
     * Example: fd[my_super_field] --> my_super_field
     */
    private function getParsedFieldname(): string
    {
        preg_match_all("/\[([^\]]*)\]/", $this->nf, $matches);

        return $matches[1][0] ?? '';
    }

}