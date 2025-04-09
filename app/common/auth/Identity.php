<?php

namespace common\auth;

use aiur\repositories\readModels\UserReadRepository;
use aiur\repositories\UserRepository;
use common\models\User;
use filsh\yii2\oauth2server\Module;
use OAuth2\Storage\UserCredentialsInterface;
use Yii;
use yii\web\IdentityInterface;

class Identity implements IdentityInterface, UserCredentialsInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->get($id);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $data = self::getOauth()->getServer()->getResourceController()->getToken();
        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function checkUserCredentials($username, $password): bool
    {
        if (!$user = self::getRepository()->getByUsername($username)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    public function getUserDetails($username): array
    {
        $user = self::getRepository()->getByUsername($username);
        return ['user_id' => $user->id];
    }

    private static function getRepository()
    {
        return \Yii::$container->get(UserRepository::class);
    }

    private static function getOauth()
    {
        return Yii::$app->getModule('oauth2');
    }
}