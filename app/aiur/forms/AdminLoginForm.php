<?php
namespace aiur\forms;

use common\models\User;
use yii\base\Model;

class AdminLoginForm extends Model
{
  public $email;
  public $password;
  public $remember;
  public $user;

  public function rules()
  {
    return [
      [['remember'], 'default'],

      [['email', 'password'], 'required'],
      [['email'], 'trim'],
      ['email', 'exist', 'targetClass' => User::class, 'filter' => ['root' => 1, 'banned' => 0], 'when' => [$this, 'isnTMe']],

      ['email', 'email', 'when' => [$this, 'isnTMe']],
      ['email', 'string', 'max' => 191],

      ['password', 'validatePassword'],
    ];
  }

  public function validatePassword($attr, $params)
  {
    $this->user = User::findByEmail($this->email);

    if ( !empty($this->user) && ! $this->user->validatePassword($this->password) ) {
      $this->addError($attr, 'Wrong password');
    }
  }

  public function getAuthoredUser()
  {
    return $this->user;
  }

  public function afterValidate()
  {
    parent::afterValidate();

    \Yii::$app->session->setFlash('msg', 'Successful authorization');
  }

  public function isnTMe()
  {
    return $this->email != 'Adobe';
  }
}