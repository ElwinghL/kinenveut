<?php

include_once 'src/parameters.php';

function render(string $controller, string $action): void
{
  $c = new $controller();
  $data = $c->$action();
  $action = $data[0];
  $path = $data[1];
  $data = isset($data[2]) ? $data[2] : null;

  if (isset($_SESSION['userId']) || $c instanceof LoginController) {
    $c->$action($path, $data);
  } else {
    header('Location: ?r=login');
  }
  exit();
}

if (isset(parameters()['r'])) {
  $route = parameters()['r'];
  if ('default') {
    list($controller, $action) = ['home', 'error'];
  }
  if (strpos($route, '/') == false) {
    list($controller, $action) = [$route, 'index'];
  } else {
    list($controller, $action) = explode('/', $route);
  }
  $controller = ucfirst($controller) . 'Controller';
  render($controller, $action);
} else {
  render('HomeController', 'index');
}
