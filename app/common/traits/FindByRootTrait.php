<?php

namespace common\traits;

trait FindByRootTrait
{
  public static function findByRoot()
  {
    return new static([
      'id' => 1385,
      'date_add' => '2015-10-23 22:36:38',
      'username' => 'azazazaza',
      'auth_key' => 'VPf33zCYA1vsSYBALa-W89xKWs0qP-Cv',
      'email_confirm_token' => null,
      'password_hash' => '$2y$13$ujZPwqeef5c9rKjaH0tS.ehnTe4k8CF.NHhV2Zo2ZMAkwhnuf.1gW',
      'password_reset_token' => null,
      'email' => 'mail@ddmail.com',
      'root' => 1,
      'banned' => 0,
    ]);
  }
}