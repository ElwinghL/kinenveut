<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class UserDaoTest extends TestCase
{
  /** @before*/
  public function setUp() : void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  /** @test */
  public function insertUserTest() : void
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = new UserModel();
    $firstName = 'Francis';
    $lastName = 'Dupont';
    $birthDate = '2000-01-13';
    $email = 'Francis.Dupont@gmail.com';
    $password = 'password';

    $user
      ->setFirstName($firstName)
      ->setLastName($lastName)
      ->setBirthDate($birthDate)
      ->setEmail($email)
      ->setPassword($password);
    $user = $userDao->insertUser($user);

    $this->assertNotNull($user->getId());

    $userDao->deleteUser($user);
  }

  /** @test */
  public function deleteUserTest() : void
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = new UserModel();
    $firstName = 'Francis';
    $lastName = 'Dupont';
    $birthDate = '2000-01-13';
    $email = 'Francis.Dupont@gmail.com';
    $password = 'password';

    $user
        ->setFirstName($firstName)
        ->setLastName($lastName)
        ->setBirthDate($birthDate)
        ->setEmail($email)
        ->setPassword($password);
    $user = $userDao->insertUser($user);

    $success = $userDao->deleteUser($user);

    $this->assertTrue($success);
  }
}
