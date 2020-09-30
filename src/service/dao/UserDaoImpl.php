<?php

class UserDaoImpl implements IUserDao
{
  public function getUserByEmailAndPassword(UserModel $user) : UserModel
  {
    $request = db()->prepare('SELECT firstName, lastName, email, isAdmin
    FROM Users
    WHERE email =:email AND password =:password');
    $params = ['email'=>$user->getEmail(), 'password'=>$user->getPassword()];
    $request->execute($params);

    $result = $request->fetch();

    $user = new UserModel($result['id'], $result['firstName'], $result['lastName'], $result['birthDate'], $result['email'], $result['isAuthorised'], $result['isAdmin']);

    return $user;
  }

  public function insertUser(UserModel $user) : bool
  {
    $request = db()->prepare('INSERT INTO Users(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $success = $request->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getBirthDate()]);

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
