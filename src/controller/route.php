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
  $c = new $controller();
  $c->$action();
} else {
  $c = new HomeController();
  $c->index();
}
