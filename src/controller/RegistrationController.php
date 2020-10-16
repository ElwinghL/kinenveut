<?php

class RegistrationController extends Controller
{
  public function index(): array
  {
    return ['render', 'index'];
  }

  public function register(): array
  {
    $errors = [];
    $values['firstName'] = filter_var(parameters()['firstName']);
    $values['lastName'] = filter_var(parameters()['lastName']);
    $values['birthDate'] = filter_var(parameters()['birthDate']);
    $values['email'] = filter_var(parameters()['email'], FILTER_VALIDATE_EMAIL);
    $values['password'] = filter_var(parameters()['password'], FILTER_UNSAFE_RAW);

    if ($values['firstName'] && strlen($values['firstName']) > 29) {
      $errors['firstName'] = 'Le prénom n\'est pas valide';
    }
    if ($values['lastName'] && strlen($values['lastName']) > 29) {
      $errors['lastName'] = 'Le nom n\'est pas valide';
    }
    if (!(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $values['birthDate'], $matches)
      && checkdate($matches[2], $matches[3], $matches[1]))
      || new DateTime($values['birthDate']) >= new DateTime()) {
      $errors['birthDate'] = 'La date de naissance n\'est pas valide';
    }
    if ($values['email'] === false) {
      $errors['email'] = 'L\'adresse mail n\'est pas valide';
    }
    if ($values['password'] && strlen($values['password']) < 8) {
      $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
    }

    $data = ['errors' => $errors, 'values' => $values];

    if (!empty($data['errors'])) {
      return ['render', 'index', $data];
    }

    $userBo = App_BoFactory::getFactory()->getUserBo();
    if ($userBo->selectUserByEmail($data['values']['email']) !== null) {
      $data['errors']['email'] = 'L\'adresse mail est déjà utilisée par un autre utilisateur';

      return ['render', 'index', $data];
    }

    $user = new UserModel();
    $user
      ->setFirstName($data['values']['firstName'])
      ->setLastName($data['values']['lastName'])
      ->setBirthDate(new DateTime($data['values']['birthDate']))
      ->setEmail($data['values']['email'])
      ->setPassword($data['values']['password'])
      ->setIsAuthorised(0);
    $userId = $userBo->insertUser($user);

    return ['redirect', '?r=login'];
  }
}
