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
      $homeController = new HomeController();
      $_SESSION['userId'] = $user->getId();
      $_SESSION['isAdmin'] = $user->getIsAdmin();
      $homeController->render('index');
    } else {
      $data['errors']['wrongIdentifiers'] = 'Identifiants incorrects';
      $loginController = new LoginController();
      $loginController->render('index', $data);
    }
  }
}
