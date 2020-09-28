<?php

class UserModel
{
  private $firstName;
  private $lastName;
  private $birthDate;
  private $email;
  private $password;

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  public function getBirthDate()
  {
    return $this->birthDate;
  }

  public function setBirthDate($birthDate)
  {
    $this->birthDate = $birthDate;

    return $this;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;

    return $this;
  }
}
