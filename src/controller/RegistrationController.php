<?php

class RegistrationController extends Controller
{
  public function check()
  {
    // todo check la validités des données
  }

  public function index()
  {
    $this->render('index');
  }

    //TODO: gérer les erreurs et contrôler la validité des données avant envoi à la bdd
    public function register()
    {
        // check()

        $userBo = App_BoFactory::getFactory()->getUserBo();
        $user = new UserModel();
        $user
            ->setFirstName($_POST['firstName'])
            ->setLastName($_POST['lastName'])
            ->setBirthDate($_POST['birthDate'])
            ->setEmail($_POST['email'])
            ->setPassword($_POST['password']);
    $success = $userBo->insertUser($user);

    if ($success == true) {
      $loginController = new LoginController();
      $loginController->index();
    } else {
      $this->render('index', $_POST);
    }
  }
}
