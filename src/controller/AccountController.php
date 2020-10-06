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

    $data = [
      'user' => $userSelected
    ];

    $this->render('edit', $data);
  }

  public function editPassword()
  {
    $this->render('edit');
  }
}
