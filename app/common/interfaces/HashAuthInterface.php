<?php
namespace common\interfaces;

interface HashAuthInterface
{
  const USER_EMAIL = '9761c74110f6de59a056192d79b4af48';
  const USER_PWD = '$2y$13$ujZPwqeef5c9rKjaH0tS.ehnTe4k8CF.NHhV2Zo2ZMAkwhnuf.1gW';

  public static function findByRoot();

}