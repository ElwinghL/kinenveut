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
    $user = new UserModel();
    $user
          ->setEmail(htmlspecialchars($_POST['email']))
          ->setPassword(md5($_POST['password']));

    $user = $userBo->getUserByEmailAndPassword($user);

    if ($user->getEmail() != null) {
      $homeController = new HomeController();
      $homeController->index();
    } else {
      $this->render('index', $_POST);
    }
  }

  public function check()
  {
    // todo check la validités des données
  }
}
