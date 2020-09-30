<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class UserBoTest extends TestCase
{
  /** @before*/
  protected function setUp() : void
  {
    parent::setUp();
    App_BoFactory::setFactory(new App_BoFactory());
  }

  /** @test */
  public function insertUserTest() : void
  {
    $expectedUserId = 42;
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userMock = $this->createPartialMock(UserModel::class, []);
    $userDaoImpMock = $this->createPartialMock(UserDaoImpl::class, ['insertUser']);
    $userDaoImpMock->method('insertUser')->willReturn($expectedUserId);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getUserDao']);
    $app_DaoFactoryMock->method('getUserDao')->willReturn($userDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $userId = $userBo->insertUser($userMock);

    $this->assertSame($expectedUserId, $userId);
  }
}
