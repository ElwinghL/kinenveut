<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class UserBoImplTest extends TestCase
{
  /** @test */
  public function insertUserTest()
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userMock = $this->createPartialMock(UserModel::class, []);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ["getFactory", "getUserDao"]);
    $userDaoImpMock = $this->createPartialMock(UserDaoImpl::class, ["insertUser"]);
    $app_DaoFactoryMock->method('getFactory')->willReturn($app_DaoFactoryMock);
    $app_DaoFactoryMock->method('getUserDao')->willReturn($userDaoImpMock);
    $userDaoImpMock->method('insertUser')->willReturn(true);

    $success = $userBo->insertUser($userMock);

    $this->assertSame($success, true);
  }
}
