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

    $this->assertNotSame('render', $data[0]);
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
}
