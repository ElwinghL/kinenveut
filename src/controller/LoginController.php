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
    $user = $userBo->selectUserByEmailAndPassword($_POST['email'], md5($_POST['password']));
    if ($user !== null) {
      $this->redirect('http://localhost/kinenveut/');
    } else {
      $errors['wrongIdentifiers'] = 'Identifiants incorrects';
      $dataTmp['errors'] = $errors;
      $_SESSION['loginData'] = $dataTmp;
      $this->redirect('http://localhost/kinenveut/?r=login');
    }
  }
}
