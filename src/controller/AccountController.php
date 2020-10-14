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
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true && isset($_SERVER['HTTP_REFERER'])){
            $data['return'] = $_SERVER['HTTP_REFERER'];
        }
      $data['user'] = $userSelected;

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
          'return' => '?r=account&userId='.$userId,
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
}
