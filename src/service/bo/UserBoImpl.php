<?php

class UserBoImpl implements IUserBo
{
  public function insertUser(UserModel $user) : UserModel
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
