<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByUserId(int $userId) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE id=?');
    $params = [$userId];
    $request->execute($params);
    $user = $request->fetch();

    if ((is_array($user) == false)
            || (is_array($user) && ($user['id'] == null || $user['id'] < 1))
        ) {
      return null;
    }

    $user = new UserModel();
    $user
            ->setId($user['id'])
            ->setFirstName(protectStringToDisplay($user['firstName']))
            ->setLastName(protectStringToDisplay($user['lastName']))
            ->setEmail(protectStringToDisplay($user['email']))
            ->setBirthDate($user['birthDate'])
            ->setIsAuthorised($user['isAuthorised'])
            ->setIsAdmin($user['isAdmin']);

    return $user;
  }
  public function selectUsersByState($state): ?array
  {    
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE isAuthorised=?');
    $params = [$state];
    $request->execute($params);
    $usersList = $request->fetchAll(PDO::FETCH_ASSOC);

    $users = [];
    foreach ($usersList as $oneUser) {
      $user = new UserModel();
      $user
        ->setId($oneUser['id'])
        ->setFirstName(protectStringToDisplay($oneUser['firstName']))
        ->setLastName(protectStringToDisplay($oneUser['lastName']))
        ->setEmail(protectStringToDisplay($oneUser['email']))
        ->setBirthDate($oneUser['birthDate'])
        ->setIsAuthorised($oneUser['isAuthorised'])
        ->setIsAdmin($oneUser['isAdmin']);

      array_push($users, $user);
    }

    return $users;
  }

  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin, password FROM User WHERE email=?');
    $params = [$email];
    $request->execute($params);
    $firstUser = $request->fetch();

    if (!(is_array($firstUser) && isset($firstUser['password']))) {
      return null;
    }

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
