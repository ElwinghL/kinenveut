<?php

class AccountController extends Controller
{
  /*Return Account page with user informations*/
  public function index()
  {
    $userId = $_GET['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $data = [
        'user' => $userSelected
      ];

      $this->render('index', $data);
    } else {
      $this->redirect('?r=home');
    }
  }

  /*Return page to edit account informations*/
  public function edit()
  {
    $userId = $_GET['userId'];
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userSelected = $userBo->selectUserByUserId($userId);

    if (isset($userSelected) && $userSelected->getId() > 0) {
      $data = [
        'user' => $userSelected
      ];

      $this->render('edit', $data);
    } else {
      $this->redirect('?r=home');
    }
  }

  public function update()
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
        $this->render('edit', $data);
        exit();
      }
      if ($email != $userSelected->getEmail() && $userBo->selectUserByEmail($email) !== null) {
        $userSelected->setFirstName($_POST['firstName']);
        $userSelected->setLastName($_POST['lastName']);
        $userSelected->setEmail($_POST['email']);
        $data['user'] = $userSelected;
        $data['errors']['email'] = 'L\'adresse mail est déjà utilisée par un autre utilisateur';
        $this->render('edit', $data);
        exit();
      }

      $userSelected->setFirstName($_POST['firstName']);
      $userSelected->setLastName($_POST['lastName']);
      $userSelected->setEmail($_POST['email']);
      $data['user'] = $userSelected;

      $userBo->updateUser($userSelected);

      $this->render('index', $data);
    } else {
      $this->redirect('?r=home');
    }
  }
}
