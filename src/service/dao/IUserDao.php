<?php

interface IUserDao
{
  public function selectUserByUserId(int $userId): ?UserModel;

  public function selectUsersByState(int $state): ?array;

  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel;

  public function selectUserByEmail(String $email) : ?UserModel;

  public function insertUser(UserModel $user) : ?int;

  public function updateUserIsAuthorised(UserModel $user) : bool;

  public function deleteUser(int $userId) : bool;
}
