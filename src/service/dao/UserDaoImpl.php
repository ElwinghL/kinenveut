<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByUserId(int $userId): ?UserModel
  {
    $request = 'SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE id=?';

    $query = db()->prepare($request);
    $query->execute([$userId]);
    $userSelected = $query->fetch();

    $user = null;
    if ($userSelected) {
      $user = new UserModel();
      $user
        ->setId($userSelected['id'])
        ->setFirstName(protectStringToDisplay($userSelected['firstName']))
        ->setLastName(protectStringToDisplay($userSelected['lastName']))
        ->setEmail(protectStringToDisplay($userSelected['email']))
        ->setBirthDate($userSelected['birthDate'])
        ->setIsAuthorised($userSelected['isAuthorised'])
        ->setIsAdmin($userSelected['isAdmin']);
    }

    return $user;
  }

  public function selectUsersByState(?int $state): ?array
  {
    $request = 'SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE isAuthorised' . ($state === null ? ' is ?' : '=?');

    $query = db()->prepare($request);
    $query->execute([$state]);
    $usersList = $query->fetchAll(PDO::FETCH_ASSOC);

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

  public function selectUserByEmailAndPassword(string $email, string $password): ?UserModel
  {
    $request = 'SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin, password FROM User WHERE email=?';

    $query = db()->prepare($request);
    $query->execute([$email]);
    $firstUser = $query->fetch();

    $user = null;
    if ($firstUser !== null && password_verify($password, $firstUser['password'])) {
      $user = new UserModel();
      $user
        ->setId($firstUser['id'])
        ->setFirstName(protectStringToDisplay($firstUser['firstName']))
        ->setLastName(protectStringToDisplay($firstUser['lastName']))
        ->setEmail(protectStringToDisplay($firstUser['email']))
        ->setBirthDate($firstUser['birthDate'])
        ->setIsAuthorised($firstUser['isAuthorised'])
        ->setIsAdmin($firstUser['isAdmin']);
    }

    return $user;
  }

  public function selectUserByEmail(string $email): ?UserModel
  {
    $request = 'SELECT * FROM User WHERE email=?';

    $request = db()->prepare($request);
    $request->execute([$email]);
    $firstUser = $request->fetch();

    $user = null;
    if ($firstUser) {
      $user = new UserModel();
      $user
        ->setId($firstUser['id'])
        ->setFirstName(protectStringToDisplay($firstUser['firstName']))
        ->setLastName(protectStringToDisplay($firstUser['lastName']))
        ->setEmail(protectStringToDisplay($firstUser['email']))
        ->setBirthDate($firstUser['birthDate'])
        ->setIsAuthorised($firstUser['isAuthorised'])
        ->setIsAdmin($firstUser['isAdmin']);
    }

    return $user;
  }

  public function insertUser(UserModel $user): ?int
  {
    $request = 'INSERT INTO User(firstName, lastName, email, password, birthDate, isAdmin,isAuthorised) VALUES (?, ?, ?, ?, ?, false,?)';

    try {
      $query = db()->prepare($request);
      $query->execute([utf8_decode($user->getFirstName()), utf8_decode($user->getLastName()), utf8_decode($user->getEmail()), $user->getPassword(), $user->getBirthDate(), $user->getIsAuthorised()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function updateUserIsAuthorised(UserModel $user): bool
  {
    $request = 'UPDATE User SET isAuthorised = :isAuthorised WHERE id = :id';

    $query = db()->prepare($request);

    return $query->execute(['id' => $user->getId(), 'isAuthorised' => $user->getIsAuthorised()]);
  }

  public function updateUser(UserModel $user): bool
  {
    $request = 'UPDATE User SET firstName = ?, lastName = ?, email = ? WHERE id = ?';

    $query = db()->prepare($request);

    return  $query->execute([utf8_decode($user->getFirstName()), utf8_decode($user->getLastName()), utf8_decode($user->getEmail()), $user->getId()]);
  }

  public function deleteUser(int $userId): bool
  {
    $request = 'DELETE FROM User WHERE id=?';

    $query = db()->prepare($request);

    return  $query->execute([$userId]);
  }
}
