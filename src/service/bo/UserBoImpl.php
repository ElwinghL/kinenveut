<?php

class UserBoImpl implements IUserBo
{
  public function insertUser(UserModel $user)
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->insertUser($user);

    return $success;
  }

  public function selectUser(String $email)
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUser($email);

    return $user;
  }
}