<?php

class AccountController extends Controller
{
  /*Return Account page with user informations*/
  public function index(): array
  {
    $userId = parameters()['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $data = [
        'user' => $userSelected
      ];

      return ['render', 'index', $data];
    } else {
      return ['redirect', '?r=home'];
    }
  }

  /*Return page to edit account informations*/
  public function edit(): array
  {
    $userId = parameters()['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $data = [
        'user' => $userSelected
      ];

      return ['render', 'edit', $data];
    } else {
      return ['redirect', '?r=home'];
    }
  }

  public function update(): array
  {
    $userId = parameters()['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $email = filter_var(parameters()['email'], FILTER_VALIDATE_EMAIL);
      if ($email === false) {
        $userSelected->setFirstName(parameters()['firstName']);
        $userSelected->setLastName(parameters()['lastName']);
        $userSelected->setEmail(parameters()['email']);
        $data['user'] = $userSelected;
        $data['errors']['email'] = 'L\'adresse mail n\'est pas valide';

        return ['render', 'edit', $data];
      }
      if ($email != $userSelected->getEmail() && $userBo->selectUserByEmail($email) !== null) {
        $userSelected->setFirstName(parameters()['firstName']);
        $userSelected->setLastName(parameters()['lastName']);
        $userSelected->setEmail(parameters()['email']);
        $data['user'] = $userSelected;
        $data['errors']['email'] = 'L\'adresse mail est déjà utilisée par un autre utilisateur';

        return ['render', 'edit', $data];
      }

      $userSelected->setFirstName(parameters()['firstName']);
      $userSelected->setLastName(parameters()['lastName']);
      $userSelected->setEmail(parameters()['email']);
      $data['user'] = $userSelected;

      $userBo->updateUser($userSelected);

      return ['render', 'index', $data];
    } else {
      return ['redirect', '?r=home'];
    }
  }

  public function info(): array
  {
    $userId = parameters()['id'];
    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);

    $data = [
      'user' => $user
    ];

    return['render', 'index', $data];
  }
}
