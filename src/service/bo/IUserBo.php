<?php

interface IUserBo
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel;

  public function selectUserByEmail(String $email) : ?UserModel;

  public function insertUser(UserModel $user) : ?int;

  public function deleteUser(int $userId) : bool;
}
