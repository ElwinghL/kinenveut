<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class RegistrationControllerTest extends TestCase
{
  /**
   * @test
   * @covers RegistrationController
   */
  public function indexTest()
  {
    $registrationController = new RegistrationController();
    $data = $registrationController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerTest()
  {
    setParameters(['firstName' => 'Jean', 'lastName' => 'Claude', 'birthDate' => '2000-05-05', 'email' => 'jean@claude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=login', $data[1]);

    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userBo->deleteUser($data[2]);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidFirstNameTest()
  {
    setParameters(['firstName' => 'JeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJeanJean', 
    'lastName' => 'Claude', 'birthDate' => '2000-05-05', 'email' => 'jean@claude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['firstName']);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidLastNameTest()
  {
    setParameters(['firstName' => 'Jean', 
    'lastName' => 'ClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaudeClaude', 
    'birthDate' => '2000-05-05', 'email' => 'jean@claude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['lastName']);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidBirthdateTest()
  {
    setParameters(['firstName' => 'Jean', 'lastName' => 'Claude', 'birthDate' => '2000-1500', 'email' => 'jean@claude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['birthDate']);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidEmailTest()
  {
    setParameters(['firstName' => 'Jean', 'lastName' => 'Claude', 'birthDate' => '2000-05-05', 'email' => 'jeanclaude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['email']);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidEmail2Test()
  {
    setParameters(['firstName' => 'Jean', 'lastName' => 'Claude', 'birthDate' => '2000-05-05', 'email' => 'jean@claude.fr', 'password' => 'password' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(new UserModel());

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['email']);
  }

  /**
   * @test
   * @covers RegistrationController
   */
  public function registerWithInvalidPasswordTest()
  {
    setParameters(['firstName' => 'Jean', 'lastName' => 'Claude', 'birthDate' => '2000-05-05', 'email' => 'jean@claude.fr', 'password' => 'pass' ]);
    
    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByEmail']);
    $userBoMock->method('selectUserByEmail')->willReturn(null);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getUserBo']);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $registrationController = new RegistrationController();
    $data = $registrationController->register();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertNotNull($data[2]['errors']['password']);
  }
}
