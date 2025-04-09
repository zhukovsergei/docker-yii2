<?php

namespace backend\tests\functional;

use \backend\tests\FunctionalTester;
use common\fixtures\UserFixture as UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
  public function _before(FunctionalTester $I)
  {
    $I->haveFixtures([
      'user' => [
        'class' => UserFixture::class,
        'dataFile' => codecept_data_dir() . 'login_data.php'
      ]
    ]);
  }

  public function loginAdminUser(FunctionalTester $I)
  {
    $I->amOnPage('auth/index');
    $I->fillField('fd[email]', 'mail@tdsgn.ru');
    $I->fillField('fd[password]', 'mail@tdsgn.ru');
    $I->click('#auth-ready-panel button[type=submit]');
    $I->see('Successful authorization');
  }

  public function cannotLoginBannedAdminUser(FunctionalTester $I)
  {
    $I->amOnPage('auth/index');
    $I->fillField('fd[email]', 'bannedAdmin@tdsgn.ru');
    $I->fillField('fd[password]', 'mail@tdsgn.ru');
    $I->click('#auth-ready-panel button[type=submit]');
    $I->dontSee('Successful authorization');
    $I->see('Пожалуйста авторизуйтесь');
  }

  public function wrongPasswordAdminUser(FunctionalTester $I)
  {
    $I->amOnPage('auth/index');
    $I->fillField('fd[email]', 'mail@tdsgn.ru');
    $I->fillField('fd[password]', 'asdfsjkfgdfg');
    $I->click('#auth-ready-panel button[type=submit]');
    $I->dontSee('Successful authorization');
    $I->see('Пожалуйста авторизуйтесь');
  }

  public function notAdminUser(FunctionalTester $I)
  {
    $I->amOnPage('auth/index');
    $I->fillField('fd[email]', 'vasya@mail.ru');
    $I->fillField('fd[password]', 'vasya@mail.ru');
    $I->click('#auth-ready-panel button[type=submit]');
    $I->dontSee('Successful authorization');
    $I->see('Пожалуйста авторизуйтесь');
  }

}
