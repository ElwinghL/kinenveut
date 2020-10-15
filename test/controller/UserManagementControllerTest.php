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
  public function deleteTest()
  {
    $userTest1 = new UserModel();
    $userTest2 = new UserModel();
    $expectedId = 42;
    $expectedIsAdmin = true;
    $userTest1
      ->setId($expectedId)
      ->setIsAdmin($expectedIsAdmin)
      ->setIsAuthorised(0);
    $userTest2
      ->setId($expectedId + 1)
      ->setIsAdmin($expectedIsAdmin)
      ->setIsAuthorised(0);

    setParameters(['id'=>43]);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUsersByState','selectUserByUserId']);
    $userBoMock->method('selectUsersByState')->willReturn([$userTest1]);
    $userBoMock->method('selectUserbyUserId')->willReturn($userTest2);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);

    App_BoFactory::setFactory($app_BoFactoryMock);

    $userMCtrtrler = new UserManagementController();
    $data = $userMCtrtrler->delete();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['users'=>[$userTest1]], $data[2]);
    $this->assertSame(5,$userTest2->getIsAuthorised());
  }
}
