<?php

class UserDaoImpl implements IUserDao
{
  public function insertUser(UserModel $user)
  {
    $request = db()->prepare('INSERT INTO Users(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $success = $request->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getBirthDate()]);


    return $success;
  }
}
