<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE email=? AND password=?');
    $params = [$email, md5($password)];
    $success = $request->execute($params);
    if ($success == false) {
      return null;
    }
    $result = $request->fetch();
    if ($result == false) {
      return null;
    }

    $user = new UserModel();
    $user->setId($result['id'])
    ->setFirstName($result['firstName'])
    ->setLastName($result['lastName'])
    ->setEmail($result['email'])
    ->setBirthDate($result['birthDate'])
    ->setIsAuthorised($result['isAuthorised'])
    ->setIsAdmin($result['isAdmin']);

    return $user;
  }

  public function selectUserByEmail(String $email) : ?UserModel
  {
    $request = db()->prepare('SELECT * FROM User WHERE email=?');
    $success = $request->execute([$email]);
    if ($success == false) {
      return null;
    }
    $result = $request->fetch();
    if ($result == false) {
      return null;
    }

    $user = new UserModel();
    $user->setId($result['id'])
    ->setFirstName($result['firstName'])
    ->setLastName($result['lastName'])
    ->setEmail($result['email'])
    ->setBirthDate($result['birthDate'])
    ->setIsAuthorised($result['isAuthorised'])
    ->setIsAdmin($result['isAdmin']);

    return $user;
  }

  public function insertUser(UserModel $user) : ?int
  {
    $request = db()->prepare('INSERT INTO User(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $success = $request->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), md5($user->getPassword()), $user->getBirthDate()]);
    if ($success == false) {
      return null;
    }

    return db()->lastInsertId();
  }

  public function deleteUser(int $userId) : bool
  {
    $request = db()->prepare('DELETE FROM User WHERE id=?');
    $success = $request->execute([$userId]);

    return $success;
  }
}
