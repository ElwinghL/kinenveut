<?php

class UserManagementController extends Controller
{
  public function index(): array
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $users = $userBo->selectUsersByState(0);
    $allUsers = $userBo->selectAllUserExceptState0();
    $data = [
      'users'    => $users,
      'allUsers' => $allUsers
    ];

    return ['render', 'index', $data];
  }

  public function validate(): array
  {
    return $this->updateUserState(1); //Etat Accepté
  }

  public function delete(): array
  {
    return $this->updateUserState(5); //Etat refusé
  }

  public function ban()
  {
    return $this->updateUserState(6); //Etat ban
  }

  private function updateUserState($stateId)
  {
    $userId = parameters()['id'];

    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);
    $user->setIsAuthorised($stateId);

    $userBo->updateUserIsAuthorised($user);
    $users = $userBo->selectUsersByState(0);
    $allUsers = $userBo->selectAllUserExceptState0();
    $data = [
      'users'    => $users,
      'allUsers' => $allUsers
    ];

    return ['render', 'index', $data];
  }
}
