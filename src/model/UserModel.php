<?php

class UserModel
{
  private $id;
  private $firstName;
  private $lastName;
  private $birthDate;
  private $email;
  private $password;
  private $isAuthorised;
  private $isAdmin;

  public function __construct()
  {
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id): UserModel
  {
    $this->id = $id;

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

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

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

  public function getIsAuthorised()
  {
    return $this->isAuthorised;
  }

  public function setIsAuthorised($isAuthorised)
  {
    $this->isAuthorised = $isAuthorised;

    return $this;
  }

  public function getIsAdmin()
  {
    return $this->isAdmin;
  }

  public function setIsAdmin($isAdmin)
  {
    $this->isAdmin = $isAdmin;

    return $this;
  }
}
