<?php

class UserDaoImpl implements IUserDao
{
  public function insertUser(UserModel $user) : UserModel
  {
    $request = db()->prepare('INSERT INTO Users(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $request->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getBirthDate()]);
    $user->setId(db()->lastInsertId());

    return $user;
  }

  public function deleteUser(UserModel $user) : bool
  {
    $request = db()->prepare('DELETE FROM Users WHERE id=?');
    $success = $request->execute([$user->getId()]);

    return $success;
  }

  public function selectUser(String $email)
  {
    $request = db()->prepare('SELECT * FROM Users WHERE email=?');
    $request->execute([$email]);
    $user = $request->fetch();

    return $user;
  }
}
