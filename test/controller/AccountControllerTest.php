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
    $_SERVER['HTTP_REFERER'] = 'urltest';
    $_SESSION['isAdmin'] = true;

    $expectedId = 42;
    $expectedIsAdmin = false;
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->willReturn($userTest1);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame('urltest', $data[2]['return']);
    $this->assertSame($expectedId, $data[2]['user']->getId());
    $this->assertSame($expectedIsAdmin, $data[2]['user']->getIsAdmin());
    $this->assertSame(0, $data[2]['user']->getIsAuthorised());
    unset($_SESSION['isAdmin'], $_SERVER['HTTP_REFERER']);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function indexRedirectTest()
  {
    global $parameters;
    $parameters = ['userId'=>42];
    $accountController = new AccountController();

    $expectedId = 0;
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

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=home', $data[1]);
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
  public function editRedirectTest()
  {
    global $parameters;
    $parameters = ['userId'=>42];
    $accountController = new AccountController();

    $expectedId = 0;
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

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=home', $data[1]);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function updateTest()
  {
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $expectedemail = 'test@test.test';
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0)
          ->setEmail($expectedemail);

    global $parameters;
    $parameters = ['userId'=>$expectedId, 'email'=>$expectedemail, 'firstName'=>'', 'lastName'=>''];

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->update();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function updateRedirectTest()
  {
    $accountController = new AccountController();

    $expectedId = 0;
    $expectedIsAdmin = false;
    $expectedemail = 'test@test.test';
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0)
          ->setEmail($expectedemail);

    global $parameters;
    $parameters = ['userId'=>$expectedId, 'email'=>$expectedemail, 'firstName'=>'', 'lastName'=>''];

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->update();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=home', $data[1]);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function updateEmailDifferentTest()
  {
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $expectedemail = 'test@test.test';
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0)
          ->setEmail($expectedemail);

    global $parameters;
    $parameters = ['userId'=>$expectedId, 'email'=>'admin@kinenveut.fr', 'firstName'=>'', 'lastName'=>''];

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->update();

    $this->assertSame('render', $data[0]);
    $this->assertSame('edit', $data[1]);
    $this->assertSame('L\'adresse mail est déjà utilisée par un autre utilisateur', $data[2]['errors']['email']);
  }

  /**
   * @test
   * @covers AccountController
   */
  public function updateEmailValideTest()
  {
    $accountController = new AccountController();

    $expectedId = 42;
    $expectedIsAdmin = false;
    $expectedemail = 'testàtest.test';
    $userTest1 = new UserModel();
    $userTest1
          ->setId($expectedId)
          ->setIsAdmin($expectedIsAdmin)
          ->setIsAuthorised(0)
          ->setEmail($expectedemail);

    global $parameters;
    $parameters = ['userId'=>$expectedId, 'email'=>$expectedemail, 'firstName'=>'', 'lastName'=>''];

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->will($this->onConsecutiveCalls($userTest1));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accountController->update();

    $this->assertSame('render', $data[0]);
    $this->assertSame('edit', $data[1]);
    $this->assertSame('L\'adresse mail n\'est pas valide', $data[2]['errors']['email']);
  }
}
