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

  /**
   * @test
   * @covers UserDaoImpl
  */
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

    $userDao->deleteUser((int) $userId);
  }

  /**
   * @test
   * @covers UserDaoImpl
  */
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
    $userId = $userDao->insertUser($user);

    $success = $userDao->deleteUser((int) $userId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers UserDaoImpl
  */
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

    $userDao->deleteUser((int) $userId);

    $userSelected = $userDao->selectUserByEmail($email);
    $this->assertNull($userSelected);
  }

  /**
   * @test
   * @covers UserDaoImpl
  */
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
      ->setPassword(password_hash($password, PASSWORD_DEFAULT));

    $userId = $userDao->insertUser($user);

    $userSelected = $userDao->selectUserByEmailAndPassword($email, $password);
    $this->assertNotNull($userSelected);
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $userDao->deleteUser((int)$userId);

    $userSelected = $userDao->selectUserByEmailAndPassword($email, $password);
    $this->assertNull($userSelected);
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function selectUserByUserIdTest()
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

    $userSelected = $userDao->selectUserByUserId($userId);
    $this->assertNotNull($userSelected);
    $this->assertEquals($userId, $userSelected->getId());
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $userDao->deleteUser((int) $userId);

    $userSelected = $userDao->selectUserByUserId((int) $userId);
    $this->assertNull($userSelected);
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function updateUserTest()
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

    $userSelected = $userDao->selectUserByUserId($userId);
    $this->assertNotNull($userSelected);
    $this->assertEquals($userId, $userSelected->getId());
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $newFirstName = 'Jean';
    $newLastName = 'Claude';
    $newEmail = 'Jean.Claude@gmail.com';

    $userModified = $userSelected;
    $userModified->setFirstName($newFirstName);
    $userModified->setLastName($newLastName);
    $userModified->setEmail($newEmail);

    $userDao->updateUser($userModified);

    $userModifiedSelected = $userDao->selectUserByUserId($userModified->getId());
    $this->assertNotNull($userModifiedSelected);
    $this->assertEquals($newFirstName, $userModifiedSelected->getFirstName());
    $this->assertEquals($newLastName, $userModifiedSelected->getLastName());
    $this->assertEquals($newEmail, $userModifiedSelected->getEmail());

    $userDao->deleteUser((int) $userModified->getId());
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function updateUserIsAuthorisedTest()
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

    $userSelected = $userDao->selectUserByUserId($userId);
    $this->assertNotNull($userSelected);
    $this->assertEquals($userId, $userSelected->getId());
    $this->assertEquals($firstName, $userSelected->getFirstName());
    $this->assertEquals($lastName, $userSelected->getLastName());
    $this->assertEquals($birthDate, $userSelected->getBirthDate());
    $this->assertEquals($email, $userSelected->getEmail());

    $userModified = $userSelected;
    $isAuthorised = 1;
    $userModified->setIsAuthorised($isAuthorised);

    $userDao->updateUserIsAuthorised($userModified);

    $userModifiedSelected = $userDao->selectUserByUserId($userModified->getId());
    $this->assertNotNull($userModifiedSelected);
    $this->assertEquals($isAuthorised, $userModifiedSelected->getIsAuthorised());

    $userDao->deleteUser((int) $userModified->getId());
  }

  /**
   * @test
   * @covers UserDaoImpl
  */
  public function selectUsersByStateTest() : void
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

    $usersSelected = $userDao->selectUsersByState(null);

    $this->assertTrue(is_array($usersSelected));
    $this->assertNotNull($usersSelected[0]->getId());

    $userDao->deleteUser((int)$userId);
  }
}
