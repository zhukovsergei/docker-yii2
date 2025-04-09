<?php

namespace backend\tests\functional;

use \backend\tests\FunctionalTester;
use common\fixtures\UserFixture as UserFixture;
use common\models\articles\Article;

/**
 * Class LoginCest
 */
class ArticleCest
{

  public function _before(FunctionalTester $I)
  {
    $I->haveFixtures([
      'user' => [
        'class' => UserFixture::class,
        'dataFile' => codecept_data_dir() . 'admin_and_user.php'
      ]
    ]);
  }

  public function indexPage(FunctionalTester $I)
  {
    $I->amLoggedInAsAdmin();
    $I->amOnPage('/articles/index');
    $I->see('All entries');
  }

  public function addRow(FunctionalTester $I)
  {
    $I->amLoggedInAsAdmin();
    $I->amOnPage('/articles/add');

    $I->submitForm('form.form-horizontal', [
      'fd[title]' => 'Заголовок записи',
      'fd[short_text]' => 'Текст краткой записи',
      'fd[long_text]' => 'Текст полной записи',
      'fd[date_pub]' => '2017-01-01',
    ]);

    $I->see('All entries');
  }

  public function checkRow(FunctionalTester $I)
  {
    $I->seeRecord(Article::class,[
      'title' => 'Заголовок записи',
      'short_text' => 'Текст краткой записи',
      'long_text' => 'Текст полной записи',
      'date_pub' => '2017-01-01',
    ]);
  }

  public function updatePage(FunctionalTester $I)
  {
    $I->amLoggedInAsAdmin();

    $row = $I->grabRecord(Article::class,[
      'title' => 'Заголовок записи',
      'short_text' => 'Текст краткой записи',
      'long_text' => 'Текст полной записи',
      'date_pub' => '2017-01-01',
    ]);

    $I->amOnPage('/articles/update?id='.$row->id);

    $I->seeElement('form.form-horizontal');

    $I->seeInFormFields('form.form-horizontal', [
      'fd[title]' => 'Заголовок записи',
      'fd[short_text]' => 'Текст краткой записи',
      'fd[long_text]' => 'Текст полной записи',
      'fd[date_pub]' => '2017-01-01',
    ]);

    $I->submitForm('form.form-horizontal', [
      'fd[title]' => 'Новый заголовок',
      'fd[short_text]' => 'Новый текст',
      'fd[long_text]' => 'Новый текст',
      'fd[date_pub]' => '2017-02-02',
    ]);

    $I->see('All entries');

    $I->seeRecord(Article::class,[
      'title' => 'Новый заголовок',
      'short_text' => 'Новый текст',
      'long_text' => 'Новый текст',
      'date_pub' => '2017-02-02',
    ]);
  }

  public function deleteRow(FunctionalTester $I)
  {
    $I->amLoggedInAsAdmin();

    $row = $I->grabRecord(Article::class,[
      'title' => 'Новый заголовок',
      'short_text' => 'Новый текст',
      'long_text' => 'Новый текст',
      'date_pub' => '2017-02-02',
    ]);

    $I->amOnPage('/articles');

    $deleteUrl = '/articles/delete?id='.$row->id;
    $I->seeLink(null, $deleteUrl);
    $I->click("a[href*=\"{$deleteUrl}\"]");

    $I->dontSeeRecord(Article::class,[
      'id' => $row->id,
    ]);
  }

}
