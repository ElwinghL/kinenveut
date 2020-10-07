<?php

class UserDaoImpl implements IUserDao
{
  public function selectUserByUserId(int $userId) : ?UserModel
  {
    $request = 'SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE id=?';

    try {
      $query = db()->prepare($request);
      $query->execute([$userId]);
      $userSelected = $query->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    if ($userSelected == null) {
      return null;
    }

    $user = new UserModel();
    $user
            ->setId($userSelected['id'])
            ->setFirstName(protectStringToDisplay($userSelected['firstName']))
            ->setLastName(protectStringToDisplay($userSelected['lastName']))
            ->setEmail(protectStringToDisplay($userSelected['email']))
            ->setBirthDate($userSelected['birthDate'])
            ->setIsAuthorised($userSelected['isAuthorised'])
            ->setIsAdmin($userSelected['isAdmin']);

    return $user;
  }

  public function selectUsersByState($state): ?array
  {    
    $request = db()->prepare('SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin FROM User WHERE isAuthorised=?');
    try{
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
      
    }catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $users;
  }

  public function selectUserByEmailAndPassword(String $email, String $password) : ?UserModel
  {
    $request = 'SELECT id, firstName, lastName, email, birthDate, isAuthorised, isAdmin, password FROM User WHERE email=?';

    $firstUser = '';
    try {
      $query = db()->prepare($request);
      $query->execute([$email]);
      $firstUser = $query->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    if ($firstUser == null || !password_verify($password, $firstUser['password'])) {
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
    $request = 'SELECT * FROM User WHERE email=?';

    try {
      $request = db()->prepare($request);
      $request->execute([$email]);
      $firstUser = $request->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    if ($firstUser == null) {
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
    $request = 'INSERT INTO User(firstName, lastName, email, password, birthDate, isAdmin,isAuthorised) VALUES (?, ?, ?, ?, ?, false,0)';

    try {
      $query = db()->prepare($request);
      $query->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getBirthDate()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function updateUserIsAuthorised(UserModel $user) : bool
  {
    try{
      if ($user->getId() != null) {
        $request = db()->prepare('UPDATE User SET isAuthorised = :startDate WHERE id = :id');
        $success = $request->execute(['id'=>$user->getId(), 'startDate'=>$user->getIsAuthorised()]);
      }
    }catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }
    return $success;
  }
  public function updateUser(UserModel $user) : bool
  {
    $request = 'UPDATE User SET firstName = ?, lastName = ?, email = ? WHERE id = ?';

    try{
      $query = db()->prepare($request);
      $success = $query->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getId()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $success;
  }

  public function deleteUser(int $userId) : bool
  {
    $request = 'DELETE FROM User WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$userId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $success;
  }
}
