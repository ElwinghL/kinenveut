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
    $user = $userBo->selectUserByEmailAndPassword(parameters()['email'], parameters()['password']);
    if ($user !== null) {
      if ($user->getIsAuthorised() == 1) {
        $_SESSION['userId'] = $user->getId();
        $_SESSION['isAdmin'] = $user->getIsAdmin();

        return ['redirect', '?r=home'];
      } else {
        $data['errors']['wrongIdentifiers'] = 'Utilisateur non autorisé actuellement';
      }
    } else {
      $data['errors']['wrongIdentifiers'] = 'Identifiants incorrects';
    }

    return ['render', 'index', $data];
  }
}
