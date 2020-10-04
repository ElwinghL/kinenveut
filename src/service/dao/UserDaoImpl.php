<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE email=? AND password=?');
    $params = [$email, md5($password)];
    $request->execute($params);
    $firstUser = $request->fetch();

    if (($firstUser == false)
          || (is_array($firstUser) && ($firstUser['id'] == null || $firstUser['id'] < 1))
      ) {
      return null;
    }

    $user = new UserModel();
    $user
          ->setId($firstUser['id'])
          ->setFirstName(protectStringFromDB($firstUser['firstName']))
          ->setLastName(protectStringFromDB($firstUser['lastName']))
          ->setEmail(protectStringFromDB($firstUser['email']))
          ->setBirthDate($firstUser['birthDate'])
          ->setIsAuthorised($firstUser['isAuthorised'])
          ->setIsAdmin($firstUser['isAdmin']);

    return $user;
  }

  public function selectUserByEmail(String $email) : ?UserModel
  {
    $request = db()->prepare('SELECT * FROM User WHERE email=?');
    $request->execute([$email]);
    $firstUser = $request->fetch();
    if (($firstUser == false)
          || (is_array($firstUser) && ($firstUser['id'] == null || $firstUser['id'] < 1))
      ) {
      return null;
    }

    $user = new UserModel();
    $user
          ->setId($firstUser['id'])
          ->setFirstName(protectStringFromDB($firstUser['firstName']))
          ->setLastName(protectStringFromDB($firstUser['lastName']))
          ->setEmail(protectStringFromDB($firstUser['email']))
          ->setBirthDate($firstUser['birthDate'])
          ->setIsAuthorised($firstUser['isAuthorised'])
          ->setIsAdmin($firstUser['isAdmin']);

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
