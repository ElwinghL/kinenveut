<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM Users WHERE email=? AND password=?');
    $params = [protectStringBeforeSQL($email), protectStringBeforeSQL($password)];
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
    $request = db()->prepare('SELECT * FROM Users WHERE email=?');
    $success = $request->execute([protectStringBeforeSQL($email)]);
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
    $request = db()->prepare('INSERT INTO Users(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)');
    $success = $request->execute([protectStringBeforeSQL($user->getFirstName()), protectStringBeforeSQL($user->getLastName()), protectStringBeforeSQL($user->getEmail()), protectStringBeforeSQL($user->getPassword()), $user->getBirthDate()]);
    if ($success == false) {
      return null;
    }

    return db()->lastInsertId();
  }

  public function deleteUser(int $userId) : bool
  {
    $request = db()->prepare('DELETE FROM Users WHERE id=?');
    $success = $request->execute([$userId]);

    return $success;
  }
}
