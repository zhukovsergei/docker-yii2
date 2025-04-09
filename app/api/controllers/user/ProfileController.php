<?php

namespace api\controllers\user;

use common\models\User;
use yii\rest\Controller;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            'authenticator' => [
                'class' => \filsh\yii2\oauth2server\filters\auth\CompositeAuth::class,
                'authMethods' => [
                    ['class' => \yii\filters\auth\HttpBearerAuth::class],
                    ['class' => \yii\filters\auth\QueryParamAuth::class, 'tokenParam' => 'accessToken'],
                ]
            ],
            'exceptionFilter' => [
                'class' => \filsh\yii2\oauth2server\filters\ErrorToExceptionFilter::class
            ],
        ]);
    }
    /**
     * @SWG\Get(
     *     path="/user/profile",
     *     tags={"Profile"},
     *     description="Returns profile info",
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/Profile")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex(): User
    {
        return $this->findModel();
    }

    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }

    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }
}
