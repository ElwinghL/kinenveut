<?php

class FirstCest
{
  public function _before(AcceptanceTester $I)
  {
  }

  // tests
  public function ICanConnectMyself(AcceptanceTester $I)
  {
    $I->amOnPage('?r=login');
    $I->submitForm('#login_form', ['email'=>'admin@kinenveut.fr', 'password'=>'password']);
    $I->see('Recherche');
  }
}
