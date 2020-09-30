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
    $userId = $userDao->insertUser($user);

    $this->assertNotNull($userId);

    $userDao->deleteUser($userId);
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

  /** @test */
  public function selectUserByEmailTest() : void
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
    $userId = $userDao->insertUser($user);

    $userSelected = $userDao->selectUserByEmail($email);
    $this->assertNotNull($userSelected);
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $userDao->deleteUser($userId);

    $userSelected = $userDao->selectUserByEmail($email);
    $this->assertNull($userSelected);
  }

  /** @test */
  public function selectUserByEmailAndPasswordTest() : void
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
    $userId = $userDao->insertUser($user);

    $userSelected = $userDao->selectUserByEmailAndPassword($email, $password);
    $this->assertNotNull($userSelected);
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $userDao->deleteUser($userId);

    $userSelected = $userDao->selectUserByEmailAndPassword($email, $password);
    $this->assertNull($userSelected);
  }
}
