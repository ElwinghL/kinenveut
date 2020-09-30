<?php

interface IUserBo
{
  public function insertUser(UserModel $user) : UserModel;

  public function selectUser(String $email);
}
