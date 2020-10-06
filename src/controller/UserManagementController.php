<?php

class UserManagementController extends Controller
{
  public function index()
  {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users'=> $users
    ];
    $this->render('index', $data);
  }  
  public function info()
  {
    $auctionId = $_GET['id'];
    
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    $userBo = App_BoFactory::getFactory()->getUserBo();    
    $seller = $userBo->selectUserByUserId($auction->getSellerId());

    $data = [
      'auction'=> $auction,
      'seller' => $seller
    ];
    $bidcontroller=new BidController();
    $bidcontroller->render('index', $data);
  }  
  public function validate()
  { 
    $userId = $_GET['id'];
    
    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);
    $user->setIsAuthorised(1);//Etat Accepté

    $userBo->updateUserIsAuthorised($user);
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users'=> $users
    ];
    $this->render('index', $data);
  }
  public function delete()
  {
    $userId = $_GET['id'];
    
    $userBo = App_BoFactory::getFactory()->getUserBo();

    $user = $userBo->selectUserByUserId($userId);
    $user->setIsAuthorised(5);//Etat reffusé

    $userBo->updateUserIsAuthorised($user);
    $users = $userBo->selectUsersByState(0);
    $data = [
      'users'=> $users
    ];
    $this->render('index', $data);
  }
}
