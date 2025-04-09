<?php
namespace aiur\forms;

use common\models\User;
use yii\base\Model;

class SignUpUserForm extends Model
{
  public $username;
  public $email;
  public $password;
  public $root;

  public function rules()
  {
    return [
      [['username', 'email', 'password'], 'required'],
      [['username', 'email'], 'trim'],

      ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
      ['username', 'string', 'min' => 2, 'max' => 255],

      ['email', 'email'],
      ['email', 'string', 'max' => 191],
      ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

      ['password', 'string', 'min' => 6],

      ['root', 'default', 'value' => 0],

/*      ['phone', 'required'],
      [['phone'], 'filter',  'filter' => function($value) {
        return trim(preg_replace('/\D/', '', $value));
      }],
      ['phone', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],*/

    ];
  }

}