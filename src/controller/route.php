<?php

$parameters = [];

if (isset($_POST)) {
  foreach ($_POST as $k=>$v) {
    $parameters[$k] = $v;
  }
}

if (isset($_GET)) {
  foreach ($_GET as $k=>$v) {
    $parameters[$k] = $v;
  }
}

function parameters()
{
  global $parameters;

  return $parameters;
}

function render(string $controller, string $action) : void
{
  $c = new $controller();
  $data = $c->$action();
  $action = $data[0];
  $path = $data[1];
  $data = isset($data[2]) ? $data[2] : null;

  $c->$action($path, $data);
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
