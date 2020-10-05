<?php

class RegistrationController extends Controller
{
  public function check()
  {
    $errors = [];
    $values['firstName'] = filter_input(INPUT_POST, 'firstName');
    $values['lastName'] = filter_input(INPUT_POST, 'lastName');
    $values['birthDate'] = filter_input(INPUT_POST, 'birthDate');
    $values['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $values['password'] = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    if ($values['firstName'] && strlen($values['firstName']) > 29) {
      $errors['firstName'] = 'Le Prénom n\'est pas valide';
    }
    if ($values['lastName'] && strlen($values['lastName']) > 29) {
      $errors['firstName'] = 'La zone Nom n\'est pas valide';
    }
    if (!(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $values['birthDate'], $matches)
    && checkdate($matches[2], $matches[3], $matches[1])
    && DateTime::createFromFormat('d/m/Y', $values['birthDate']) < (new DateTime()))) {
      $errors['birthDate'] = 'La date de naissance n\'est pas valide';
    }
    if ($values['email'] === false) {
      $errors['email'] = 'L\'adresse mail n\'est pas valide';
    }
    if ($values['password'] && strlen($values['password']) < 8) {
      $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
    }

    return ['errors'=> $errors, 'values' => $values];
  }

  public function index()
  {
    $this->render('index');
  }

  public function register():void
  {
    $registrationController = new RegistrationController();
    $data = $this->check();
    if (!empty($data['errors'])) {
      $registrationController->render('index', $data);
    }

    $userBo = App_BoFactory::getFactory()->getUserBo();
    if ($userBo->selectUserByEmail($data['values']['email']) !== null) {
      $data['errors']['email'] = 'L\'adresse mail est déjà utilisée par un autre utilisateur';
      $registrationController->render('index', $data);
    }

    $user = new UserModel();
    $user
          ->setFirstName($data['values']['firstName'])
          ->setLastName($data['values']['lastName'])
          ->setBirthDate($data['values']['birthDate'])
          ->setEmail($data['values']['email'])
          ->setPassword($data['values']['password']);
    $userId = $userBo->insertUser($user);

    if ($userId !== null) {
      $loginController = new LoginController();
      $loginController->render('index');
    }
  }
}
