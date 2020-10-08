<?php

$data = null;

class Controller
{
  public function render(string $view, array $d = null): void
  {
    global $data;
    $controller = get_class($this);
    $model = substr($controller, 0, strpos($controller, 'Controller'));
    $data = $d;

    if (
      isset($_SESSION['userId'])
      || (strtolower($model) == 'login' || strtolower($model) == 'registration')
    ) {
      $nbDemandes = 0;
      $AuctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
      $nbDemandes = $AuctionAccessStateBo->selectNumberOfAuctionAccessStateBySellerId($_SESSION['userId']);
    }
    include_once 'src/view/header.php';
    include_once 'src/view/' . strtolower($model) . '/' . $view . '.php';
    include_once 'src/view/footer.php';
  }

  public function redirect(string $path, array $d = null): void
  {
    $arg = '';
    if (isset($d)) {
      foreach ($d as $k => $v) {
        $arg .= '&' . $k . '=' . $v;
      }
    }
    header('Location: ' . $path . $arg);
  }
}
