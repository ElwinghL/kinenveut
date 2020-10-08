<?php

class UserManagementController extends Controller
{
  public function index(): array
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users' => $users
    ];

    return ['render', 'index', $data];
  }

  public function info(): array
  {
    $userId = $_GET['id'];

    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);

    $data = [
      'user' => $user
    ];

    $accountController = new AccountController();
    $accountController->render('index', $data);
  }

  public function validate(): array
  {
    $userId = $_GET['id'];

    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);
    $user->setIsAuthorised(1); //Etat Accepté

    $userBo->updateUserIsAuthorised($user);
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users' => $users
    ];

    return ['render', 'index', $data];
  }

  public function delete(): array
  {
    $userId = $_GET['id'];

    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);
    $user->setIsAuthorised(5); //Etat reffusé

    $userBo->updateUserIsAuthorised($user);
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users' => $users
    ];

    return ['render', 'index', $data];
  }
}
