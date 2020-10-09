<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class UserDaoTest extends TestCase
{
  const FIRST_NAME = 'Francis';
  const LAST_NAME = 'Dupont';
  const BIRTH_DATE = '2000-01-13';
  const EMAIL = 'Francis.Dupont@gmail.com';
  const PASSWORD = 'password';

  private $userDao = null;
  private $user = null;

  /** @before*/
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
    $this->userDao = App_DaoFactory::getFactory()->getUserDao();
    $this->user = new UserModel();
    $this->user
      ->setFirstName(self::FIRST_NAME)
      ->setLastName(self::LAST_NAME)
      ->setBirthDate(self::BIRTH_DATE)
      ->setEmail(self::EMAIL)
      ->setPassword(self::PASSWORD);
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function insertUserTest(): void
  {
    $userId = $this->userDao->insertUser($this->user);

    $this->assertNotNull($userId);

    $this->userDao->deleteUser($userId);

    $this->expectException(BDDException::class);
    $userEmpty = new UserModel();
    $this->userDao->insertUser($userEmpty);
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function deleteUserTest(): void
  {
    $userId = $this->userDao->insertUser($this->user);

    $success = $this->userDao->deleteUser($userId);

    $this->assertTrue($success);
    $this->assertTrue($this->userDao->deleteUser(-1));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function selectUserByEmailTest(): void
  {
    $userId = $this->userDao->insertUser($this->user);

    $userSelected = $this->userDao->selectUserByEmail(self::EMAIL);

    $this->assertNotNull($userSelected);
    $this->assertEquals(self::FIRST_NAME, $userSelected->getFirstName());
    $this->assertEquals(self::LAST_NAME, $userSelected->getLastName());
    $this->assertEquals(self::BIRTH_DATE, $userSelected->getBirthDate());
    $this->assertEquals(self::EMAIL, $userSelected->getEmail());

    $this->userDao->deleteUser($userId);

    $this->assertNull($this->userDao->selectUserByEmail('notAnEmail'));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function selectUserByEmailAndPasswordTest(): void
  {
    $this->user->setPassword(password_hash($this->user->getPassword(), PASSWORD_DEFAULT));
    $userId = $this->userDao->insertUser($this->user);

    $userSelected = $this->userDao->selectUserByEmailAndPassword(self::EMAIL, self::PASSWORD);

    $this->assertNotNull($userSelected);
    $this->assertEquals(self::FIRST_NAME, $userSelected->getFirstName());
    $this->assertEquals(self::LAST_NAME, $userSelected->getLastName());
    $this->assertEquals(self::BIRTH_DATE, $userSelected->getBirthDate());
    $this->assertEquals(self::EMAIL, $userSelected->getEmail());

    $this->userDao->deleteUser($userId);

    $this->assertNull($this->userDao->selectUserByEmailAndPassword('', ''));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function selectUserByUserIdTest()
  {
    $userId = $this->userDao->insertUser($this->user);

    $userSelected = $this->userDao->selectUserByUserId($userId);

    $this->assertNotNull($userSelected);
    $this->assertEquals($userId, $userSelected->getId());
    $this->assertEquals(self::FIRST_NAME, $userSelected->getFirstName());
    $this->assertEquals(self::LAST_NAME, $userSelected->getLastName());
    $this->assertEquals(self::BIRTH_DATE, $userSelected->getBirthDate());
    $this->assertEquals(self::EMAIL, $userSelected->getEmail());

    $this->userDao->deleteUser($userId);

    $this->assertNull($this->userDao->selectUserByUserId(-1));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function updateUserTest()
  {
    $newFirstName = 'Jean';
    $newLastName = 'Claude';
    $newEmail = 'Jean.Claude@gmail.com';
    $userId = $this->userDao->insertUser($this->user);
    $userModified = $this->userDao->selectUserByUserId($userId);
    $userModified->setFirstName($newFirstName);
    $userModified->setLastName($newLastName);
    $userModified->setEmail($newEmail);

    $this->userDao->updateUser($userModified);

    $userModifiedSelected = $this->userDao->selectUserByUserId($userModified->getId());
    $this->assertNotNull($userModifiedSelected);
    $this->assertEquals($newFirstName, $userModifiedSelected->getFirstName());
    $this->assertEquals($newLastName, $userModifiedSelected->getLastName());
    $this->assertEquals($newEmail, $userModifiedSelected->getEmail());

    $this->userDao->deleteUser($userModified->getId());

    $userEmpty = new UserModel();
    $this->assertTrue($this->userDao->updateUser($userEmpty));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function updateUserIsAuthorisedTest()
  {
    $isAuthorised = 1;
    $userId = $this->userDao->insertUser($this->user);
    $userModified = $this->userDao->selectUserByUserId($userId);
    $userModified->setIsAuthorised($isAuthorised);

    $this->userDao->updateUserIsAuthorised($userModified);

    $userModifiedSelected = $this->userDao->selectUserByUserId($userModified->getId());
    $this->assertNotNull($userModifiedSelected);
    $this->assertEquals($isAuthorised, $userModifiedSelected->getIsAuthorised());

    $this->userDao->deleteUser($userModified->getId());

    $userEmpty = new UserModel();
    $this->assertTrue($this->userDao->updateUserIsAuthorised($userEmpty));
  }

  /**
   * @test
   * @covers UserDaoImpl
   */
  public function selectUsersByStateTest(): void
  {
    $isAuthorised = '0';
    $userId = $this->userDao->insertUser($this->user);
    $this->user->setId($userId);

    $usersSelected = $this->userDao->selectUsersByState(0);

    $this->assertTrue(is_array($usersSelected));
    $this->assertNotNull($usersSelected[0]->getId());

    $this->user->setIsAuthorised($isAuthorised);
    $this->userDao->updateUserIsAuthorised($this->user);

    $usersSelected = $this->userDao->selectUsersByState($isAuthorised);

    $this->assertTrue(is_array($usersSelected));
    $this->assertNotNull($usersSelected[0]->getId());

    $this->userDao->deleteUser($userId);

    $this->assertEmpty($this->userDao->selectUsersByState(-1));
  }
}
