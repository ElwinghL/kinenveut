<?php

$data = null;

class Controller
{
  public function check()
  {
    // need to override these method inside child class
  }

  public function render($view, $d = null)
  {
    global $data;
    $controller = get_class($this);
    $model = substr($controller, 0, strpos($controller, 'Controller'));
    $data = $d;

      if(isset($_SESSION['userId'])
          || (strtolower($model) == "login" || strtolower($model) == "registration")
      ){
        include_once 'src/view/header.php';
        include_once 'src/view/' . strtolower($model) . '/' . $view . '.php';
        include_once 'src/view/footer.php';
      }
      else
      {
          header("Location: ?r=login");
          exit();
      }
  }

  public function redirect($path)
  {
    header('Location: ' . $path);
    exit();
  }
}
