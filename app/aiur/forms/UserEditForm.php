<?php

namespace aiur\forms;

use common\models\User;
use yii\base\Model;

class UserEditForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $root;
    public $banned;

    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
//        $this->password = $user->password;
        $this->email = $user->email;
        $this->root = $user->root;
        $this->banned = $user->banned;
        $this->user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
      return [
        [['username', 'email'], 'required'],

        ['email', 'email'],
        ['email', 'string', 'max' => 191],
        [['email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->user->id]],

        [['root', 'banned'], 'default', 'value' => 0],

        ['password', 'string', 'min' => 6],
        [['password'], 'default'],
//        [['password'], 'safe'],
      ];
    }

}