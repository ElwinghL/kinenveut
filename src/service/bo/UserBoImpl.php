<?php

class UserBoImpl implements IUserBo
{
  public function selectUserByUserId(int $auctionId) : ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByUserId($auctionId);

    return $user;
  }

  public function selectUsersByState($state): ?array
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $users = $userDao->selectUsersBystate($state);

    return $users;
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
  
  public function updateUserIsAuthorised(UserModel $user) : ?bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $userDao->updateUserIsAuthorised($user);
    return true;
  }

  public function updateUser(UserModel $user) : bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->updateUser($user);

    return $success;
  }

  public function updateUser(UserModel $user) : bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->updateUser($user);

    return $success;
  }

  public function deleteUser(int $userId) : bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->deleteUser($userId);

    return $success;
  }
}
