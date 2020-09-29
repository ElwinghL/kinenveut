<?php

interface IUserBo
{
  public function insertUser(UserModel $user);
  public function selectUser(String $email);
}
