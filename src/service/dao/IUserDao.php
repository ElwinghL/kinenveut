<?php

interface IUserDao
{
  public function insertUser(UserModel $user) : UserModel;

  public function selectUser(String $email);
}
