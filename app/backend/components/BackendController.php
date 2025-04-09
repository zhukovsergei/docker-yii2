<?php
namespace backend\components;

use backend\components\wysiwyg\WysiwygUploadImproved;
use common\controllers\BaseController;

class BackendController extends BaseController
{
    public $enableCsrfValidation = false;
    public $redirectUrl = false;

    public function actions()
    {
        return [
            'WysiwygUpload' => [
                'class' => WysiwygUpload::class,
            ],
            'WysiwygUploadImproved' => [
                'class' => WysiwygUploadImproved::class,
            ],
            'deleteFileThroughCleaner' => [
                'class' => FileCleaner::class,
            ],
        ];
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        $location = \Yii::$app->getResponse()->getHeaders()->get('location');

        $arr = ['update', 'approve', 'delete', 'add', 'edit'];

        if( in_array($action->id, $arr) && \Yii::$app->request->isPost && empty($location) )
        {
            return $this->redirect(['index']);
        }

        return $result;
    }

}
