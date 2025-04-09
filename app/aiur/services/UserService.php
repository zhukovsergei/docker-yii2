<?php

namespace aiur\services;

use aiur\forms\SignUpUserForm;
use aiur\forms\UserEditForm;
use aiur\repositories\UserRepository;
use common\models\User;

class UserService
{
  private $userRepository;

  public function __construct( UserRepository $userRepository )
  {
    $this->userRepository = $userRepository;
  }

  public function create(SignUpUserForm $form)
  {
    $user = User::create(
      $form->username,
      $form->password,
      $form->email,
      $form->root
    );

    $this->userRepository->save($user);
  }

  public function update($id, UserEditForm $form)
  {
    $user = $this->userRepository->get($id);

    $user->edit(
      $form->username,
      $form->email,
      $form->root,
      $form->banned
    );

    if( !empty($form->password) )
    {
      $user->setPassword($form->password);
    }

    $this->userRepository->save($user);
  }
}