<?php

$data = null;

class Controller
{
  public function render($view, $d = null)
  {
    global $data;
    $controller = get_class($this);
    $model = substr($controller, 0, strpos($controller, 'Controller'));
    $data = $d;

    if (isset($_SESSION['userId'])
          || (strtolower($model) == 'login' || strtolower($model) == 'registration')
      ) {
      $nbDemandes = 0;
      if (isset($_SESSION['userId'])) {
        $AuctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
        $nbDemandes = $AuctionAccessStateBo->selectNumberOfAuctionAccessStateBySellerId($_SESSION['userId']);
      }
      include_once 'src/view/header.php';
      include_once 'src/view/' . strtolower($model) . '/' . $view . '.php';
      include_once 'src/view/footer.php';
    } else {
      header('Location: ?r=login');
    }
    exit();
  }

  public function redirect($path)
  {
    header('Location: ' . $path);
    exit();
  }
}
