<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin, password FROM User WHERE email=?');
    $params = [$email];
    $request->execute($params);
    $firstUser = $request->fetch();

    $isPasswordCorrect = password_verify($password, $firstUser['password']);

    if (($firstUser == false)
          || (is_array($firstUser) && ($firstUser['id'] == null || $firstUser['id'] < 1)
          || !$isPasswordCorrect)
      ) {
      return null;
    }

    $user = new UserModel();
    $user
          ->setId($firstUser['id'])
          ->setFirstName(protectStringToDisplay($firstUser['firstName']))
          ->setLastName(protectStringToDisplay($firstUser['lastName']))
          ->setEmail(protectStringToDisplay($firstUser['email']))
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
          ->setFirstName(protectStringToDisplay($firstUser['firstName']))
          ->setLastName(protectStringToDisplay($firstUser['lastName']))
          ->setEmail(protectStringToDisplay($firstUser['email']))
          ->setBirthDate($firstUser['birthDate'])
          ->setIsAuthorised($firstUser['isAuthorised'])
          ->setIsAdmin($firstUser['isAdmin']);

    return $user;
  }

  public function insertUser(UserModel $user) : ?int
  {
    $request = db()->prepare('INSERT INTO User(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $success = $request->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), password_hash($user->getPassword(), PASSWORD_DEFAULT), $user->getBirthDate()]);
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
