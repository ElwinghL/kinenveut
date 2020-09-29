<?php

interface IUserDao
{
  public function insertUser(UserModel $user);
  public function selectUser(String $email);
}
