<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class UserModelTest extends TestCase
{
  /** @test */
  public function getterSetterTest()
  {
    $user = new UserModel();
    $firstName = 'Francis';
    $lastName = 'Dupont';
    $birthDate = '13/01/2000';
    $email = 'Francis.Dupont@gmail.com';
    $password = 'password';

    $user
      ->setFirstName($firstName)
      ->setLastName($lastName)
      ->setBirthDate($birthDate)
      ->setEmail($email)
      ->setPassword($password);

    $this->assertSame($user->getFirstName(), $firstName);
    $this->assertSame($user->getLastName(), $lastName);
    $this->assertSame($user->getBirthDate(), $birthDate);
    $this->assertSame($user->getEmail(), $email);
    $this->assertSame($user->getPassword(), $password);
  }
}
