<?php

interface IUserDao
{
  public function selectUserByUserId(int $userId): ?UserModel;

  public function selectUsersByState(int $state): array;

  public function selectAllUserExceptState0(): array;

  public function selectUserByEmailAndPassword(string $email, string $password): ?UserModel;

  public function selectUserByEmail(string $email): ?UserModel;

  public function insertUser(UserModel $user): ?int;

  public function updateUserIsAuthorised(UserModel $user): bool;

  public function updateUser(UserModel $user): bool;

  public function deleteUser(int $userId): bool;
}
