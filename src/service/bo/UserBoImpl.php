<?php

class UserBoImpl implements IUserBo
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByEmailAndPassword($email, $password);

    return $user;
  }

  public function selectUserByEmail(String $email) : ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByEmail($email);

    return $user;
  }

  public function insertUser(UserModel $user) : ?int
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $userId = $userDao->insertUser($user);

    return $userId;
  }
}
