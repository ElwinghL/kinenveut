<?php

class LoginController extends Controller
{
  public function index()
  {
    $this->render('index');
  }

  public function login()
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $user = $userBo->selectUserByEmailAndPassword($_POST['email'], $_POST['password']);
    if ($user !== null) {
      $_SESSION['userId'] = $user->getId();
      $_SESSION['isAdmin'] = $user->getIsAdmin();
      $homeController = new HomeController();
      $homeController->index();
    } else {
      $data['errors']['wrongIdentifiers'] = 'Identifiants incorrects';
      $this->render('index', $data);
    }
  }
}
