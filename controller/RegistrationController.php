<?php

class RegistrationController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->render('index');
    }

    //TODO: gérer les erreurs et contrôler la validité des données avant envoi à la bdd
    public function register()
    {
        $userModel = new UserModel();
        $user = $userModel->newUser(
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['birthDate'],
            $_POST['email'],
            $_POST['password']
        );
        if ($user == true) {
            $loginController = new LoginController();
            $loginController->index();
        } else {
            $this->render('index', $_POST);
        }
    }
}
