<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class MainPageCest
{
    public function checkSuccessLoad(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }
}
