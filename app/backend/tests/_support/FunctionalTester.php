<?php
namespace backend\tests;
use common\models\User;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;
   /**
    * Define custom actions here
    */

  public function amLoggedInAsAdmin()
  {
    $this->amLoggedInByEmail('mail@tdsgn.ru');
  }

/*  public function amLoggedInAsUser()
  {
    $this->amLoggedInByUsername('user');
  }*/

  public function amLoggedInByEmail($email)
  {
    $I = $this;
    $I->amLoggedInAs($I->grabRecord(User::class, ['email' => $email]));
  }
}
