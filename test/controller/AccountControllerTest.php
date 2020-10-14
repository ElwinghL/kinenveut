<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class AccountControllerTest extends TestCase
{
  /**
   * @test
   * @covers AccountController
   */
  public function indexTest()
  {
    global $parameters;
    $parameters = ['userId'=>42];
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function editTest()
  {
    global $parameters;
    $parameters = ['userId'=>42];
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->edit();

    $this->assertSame('render', $data[0]);
    $this->assertSame('edit', $data[1]);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function updateTest()
  {
    global $parameters;
    $parameters = ['userId'=>42];
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->edit();

    $this->assertSame('render', $data[0]);
    $this->assertSame('edit', $data[1]);
  }
}
