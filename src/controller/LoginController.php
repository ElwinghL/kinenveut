<?php

class LoginController extends Controller
{
  public function index(): array
  {
    return ['render', 'index'];
  }

  public function login(): array
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $user = $userBo->selectUserByEmailAndPassword($_POST['email'], $_POST['password']);
    if ($user !== null) {
      $_SESSION['userId'] = $user->getId();
      $_SESSION['isAdmin'] = $user->getIsAdmin();

      return ['redirect', '?r=home'];
    } else {
      $data['errors']['wrongIdentifiers'] = 'Identifiants incorrects';

      return ['render', 'index', $data];
    }
  }
}
