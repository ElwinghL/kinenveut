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

  public function register():void
  {
    $firstName = trim($_POST['firstName']);
    $noTags = strip_tags($firstName);
    if ($firstName != $noTags) {
    $errors['firstName'] = 'La zone Prénom ne peut pas contenir de code HTML';
    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z\- ']{1,29}$/", $firstName)) {
    $errors['firstName'] = 'La zone Prénom n\'est pas valide';
    }

    $lastName = trim($_POST['lastName']);
    $noTags = strip_tags($lastName);
    if ($lastName != $noTags) {
    $errors['lastName'] = 'La zone Nom ne peut pas contenir de code HTML';
    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z\- ']{1,29}$/", $lastName)) {
    $errors['lastName'] = 'La zone Nom n\'est pas valide';
    }

    $birthDate = $_POST['birthDate'];
    if (strtotime($birthDate) >= strtotime(date("Y-m-d"))) {
        $errors['birthDate'] = 'La date de naissance doit être valide';
    } 

    $password = trim($_POST['password']);
    $nb = strlen($password);
    $noTags = strip_tags($password);
    if (strlen($noTags) != $nb) {
        $errors['password'] = 'La zone Mot de passe ne peut pas contenir de code HTML';
    } elseif ($nb < 8) {
        $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
    }

    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse mail doit être valide";
    }
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userWithSameEmail = $userBo->selectUser($email);
    if ($userWithSameEmail !== false){
      $errors['emailAlreadyInUse'] = "L'adresse mail renseignée est déjà utilisée par un autre utilisateur";
    }

    if (!isset($errors)) {
        $user = new UserModel();
        $user
          ->setFirstName($firstName)
          ->setLastName($lastName)
          ->setBirthDate($birthDate)
          ->setEmail($email)
          ->setPassword(md5($password));
        $success = $userBo->insertUser($user);
        if ($success == true) {
          $this->redirect('http://localhost/kinenveut/?r=login');
        } else {
          $errors['dbError'] = "Une erreur s'est produite avec la base de données";
          $dataTmp = $_POST;
          $dataTmp['errors'] = $errors;
          $_SESSION['registerData'] = $dataTmp;
          $this->redirect('http://localhost/kinenveut/?r=registration');
        }
    } else {
        $dataTmp = $_POST;
        $dataTmp['errors'] = $errors;
        $_SESSION['registerData'] = $dataTmp;
        $this->redirect('http://localhost/kinenveut/?r=registration');
    }
  }
}

