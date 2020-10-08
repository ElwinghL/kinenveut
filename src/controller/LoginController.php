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
      switch ($user->getIsAuthorised()) {
        case 0:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur pas encore validé';
          break;
        case 1:
          $_SESSION['userId'] = $user->getId();
          $_SESSION['isAdmin'] = $user->getIsAdmin();

          return ['redirect', '?r=home'];
          break;
        case 2:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur annulé';
          break;
        case 3:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur arrété';
          break;
        case 4:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur terminé';
          break;
        case 5:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur refusé';
          break;
        case 5:
          $data['errors']['wrongIdentifiers'] = 'Utilisateur banni';
          break;
}
      if ($user->getIsAuthorised() == 1) {
      } else {
      }
    } else {
      $data['errors']['wrongIdentifiers'] = 'Identifiants incorrects';
    }

    return ['render', 'index', $data];
  }
}
