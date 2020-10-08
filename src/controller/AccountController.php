<?php

class AccountController extends Controller
{
  /*Return Account page with user informations*/
  public function index(): array
  {
    $userId = $_GET['userId'];
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
    $userId = $_GET['userId'];
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
    $userId = $_GET['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      if ($email === false) {
        $userSelected->setFirstName($_POST['firstName']);
        $userSelected->setLastName($_POST['lastName']);
        $userSelected->setEmail($_POST['email']);
        $data['user'] = $userSelected;
        $data['errors']['email'] = 'L\'adresse mail n\'est pas valide';

        return ['render', 'edit', $data];
        exit();
      }
      if ($email != $userSelected->getEmail() && $userBo->selectUserByEmail($email) !== null) {
        $userSelected->setFirstName($_POST['firstName']);
        $userSelected->setLastName($_POST['lastName']);
        $userSelected->setEmail($_POST['email']);
        $data['user'] = $userSelected;
        $data['errors']['email'] = 'L\'adresse mail est déjà utilisée par un autre utilisateur';

        return ['render', 'edit', $data];
        exit();
      }

      $userSelected->setFirstName($_POST['firstName']);
      $userSelected->setLastName($_POST['lastName']);
      $userSelected->setEmail($_POST['email']);
      $data['user'] = $userSelected;

      $userBo->updateUser($userSelected);

      return ['render', 'index', $data];
    } else {
      return ['redirect', '?r=home'];
    }
  }
}
