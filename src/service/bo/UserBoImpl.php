<?php

class UserBoImpl implements IUserBo
{
  public function getUserByEmailAndPassword(UserModel $user) : UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->getUserByEmailAndPassword($user);

    return $user;
  }

  public function insertUser(UserModel $user)
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->insertUser($user);

    return $user;
  }

  public function selectUser(String $email)
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUser($email);

    return $user;
  }
}
