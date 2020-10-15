<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class UserManagementControllerTest extends TestCase
{
  /**
   * @test
   * @covers UserManagementController
   */
  public function indexTest()
  {
    $userTest1 = new UserModel();
    $expectedId = 42;
    $expectedIsAdmin = true;
    $userTest1
      ->setId($expectedId)
      ->setIsAdmin($expectedIsAdmin)
      ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUsersByState']);
    $userBoMock->method('selectUsersByState')->willReturn([$userTest1]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);

    App_BoFactory::setFactory($app_BoFactoryMock);

    $userMCtrtrler = new UserManagementController();
    $data = $userMCtrtrler->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['users'=>[$userTest1]], $data[2]);
  }

  /**
   * @test
   * @covers UserManagementController
   */
  public function updateUserStateTest()
  {
    setParameters(['id' => 42]);
    $userTest1 = new UserModel();
    $userTest1
      ->setId(42)
      ->setIsAdmin(true)
      ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId', 'selectUsersByState', 'updateUserIsAuthorised']);
    $userBoMock->method('selectUserByUserId')->willReturn($userTest1);
    $userBoMock->method('updateUserIsAuthorised')->willReturn(true);
    $userBoMock->method('selectUsersByState')->willReturn([$userTest1]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $userMCtrtrler = new UserManagementController();
    $data = $userMCtrtrler->validate();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['users'=>[$userTest1]], $data[2]);

    $data = $userMCtrtrler->delete();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['users'=>[$userTest1]], $data[2]);

    $data = $userMCtrtrler->ban();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['users'=>[$userTest1]], $data[2]);
  }
}
