<?php

class UserBoImpl implements IUserBo
{
  public function selectUserByUserId(int $auctionId) : ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByUserId($auctionId);

    return $user;
  }

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
    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
    $userId = $userDao->insertUser($user);

    return $userId;
  }

  public function deleteUser(int $userId) : bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $userId = $userDao->deleteUser($userId);

    return $userId;
  }
}
