<?php

class UserBoImpl implements IUserBo
{
  public function selectUserByUserId(int $auctionId): ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByUserId($auctionId);

    return $user;
  }

  public function selectUsersByState(int $state): array
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $users = $userDao->selectUsersBystate($state);

    return $users;
  }

  public function selectAllUserExceptState0(): array
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $users = $userDao->selectAllUserExceptState0();

    return $users;
  }

  public function selectUserByEmailAndPassword(string $email, string $password): ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByEmailAndPassword($email, $password);

    return $user;
  }

  public function selectUserByEmail(string $email): ?UserModel
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByEmail($email);

    return $user;
  }

  public function insertUser(UserModel $user): ?int
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
    $userId = $userDao->insertUser($user);

    return $userId;
  }

  public function updateUserIsAuthorised(UserModel $user): bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->updateUserIsAuthorised($user);

    return $success;
  }

  public function updateUser(UserModel $user): bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->updateUser($user);

    if ($user->getIsAuthorised() == 6) {
      $userId = $user->getId();

      $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
      $aasAreUpdated = $auctionAccessStateDao->cancelAuctionAccessStateByUserId($userId);

      $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();
      $bhAreUpdated = $bidHistoryDao->deleteCurrentBidsByBidderId($userId);

      $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
      $auctionsAreUpdated = $auctionDao->cancelOnlineAuctionsBySellerId($userId);
    }

    return $success;
  }

  public function deleteUser(int $userId): bool
  {
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $success = $userDao->deleteUser($userId);

    return $success;
  }
}
