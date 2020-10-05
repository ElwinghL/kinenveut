<?php

class LogoutController extends Controller
{
  public function index()
  {
    session_destroy();
    $loginController = new LoginController();
    $loginController->login();
  }
}
