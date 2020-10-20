<?php

function checkUrl($expectedUrl)
{
  $session = Universe::getUniverse()->getSession();
  $currentUrl = $session->getCurrentUrl();
  if ($session->getStatusCode() !== 200) {
    throw new Exception('status code is not 200');
  }
  if ($currentUrl !== $expectedUrl) {
    throw new Exception('The current url "' . $currentUrl . '" is not the expected one "' . $expectedUrl . '"');
  }
}

function checkUrlPartial($session, $expectedUrl)
{
  $currentUrl = $session->getCurrentUrl();
  if ($session->getStatusCode() !== 200) {
    throw new Exception('status code is not 200');
  }
  if (strpos($currentUrl, $expectedUrl) === false) {
    throw new Exception('The current url "' . $currentUrl . '" do not contain "' . $expectedUrl . '"');
  }
}

/*Visit pages / Click on button*/

function visitOwnAccountPage($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuAccount'
  )->click();

  checkUrlPartial($session, 'http://localhost/kinenveut/?r=account&userId=');
}

function visitCreateAuction($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuCreateAuction'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=auction/create');
}

function visitSells($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuSells'
  )->click();

  $user = Universe::getUniverse()->getUser();

  if ($user->getId() == null || $user->getId() <= 1) {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userFromDb = $userBo->selectUserByEmail($user->getEmail());
    Universe::getUniverse()->getUser()->setId($userFromDb->getId());
    $user->setId($userFromDb->getId());
  }
  checkUrl('http://localhost/kinenveut/?r=auction/sells/&userId=' . $user->getId());
}

function visitBids($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuBids'
  )->click();

  $user = Universe::getUniverse()->getUser();
  if ($user->getId() == null || $user->getId() <= 1) {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userFromDb = $userBo->selectUserByEmail($user->getEmail());
    Universe::getUniverse()->getUser()->setId($userFromDb->getId());
    $user->setId($userFromDb->getId());
  }
  checkUrl('http://localhost/kinenveut/?r=auction/bids&userId=' . $user->getId());
}

function visitAuctionManagement($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuAuctionManagement'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=auctionManagement');
}

function visitUserManagment($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuUserManagement'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=userManagement');
}

function visitCategoriesManagment($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuCategoryManagement'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=categorie');
}

function visitRegistrationPage($session)
{
  /*Go to suscribe page*/
  $session->getPage()->find(
    'css',
    'a[href="?r=registration"]'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=registration');
}

function visitRequestPage($session)
{
  $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  )->click();
  $session->getPage()->find(
    'css',
    '#menuRequest'
  )->click();

  $url = '?r=accessRequest';
  checkUrlPartial($session, $url);
}

/*Suscribe & Connection functions*/

function suscribe($session, UserModel $localUser)
{
  checkUrl('http://localhost/kinenveut/?r=registration');

  /*Fill the form*/
  $session->getPage()->find(
    'css',
    'input[name="firstName"]'
  )->setValue($localUser->getFirstName());
  $session->getPage()->find(
    'css',
    'input[name="lastName"]'
  )->setValue($localUser->getLastName());
  $session->getPage()->find(
    'css',
    'input[name="birthDate"]'
  )->setValue($localUser->getBirthDate()->format('d/m/Y'));
  $session->getPage()->find(
    'css',
    'input[name="email"]'
  )->setValue($localUser->getEmail());
  $session->getPage()->find(
    'css',
    'input[name="password"]'
  )->setValue($localUser->getPassword());

  /*Click on suscribe*/
  $session->getPage()->find(
    'css',
    'input[type="submit"]'
  )->click();

  //The user is redirect to the login page
  checkUrl('http://localhost/kinenveut/?r=login');
}

function connect($session, UserModel $user)
{
  checkUrl('http://localhost/kinenveut/?r=login');

  /*Fill the form*/
  $session->getPage()->find(
    'css',
    'input[name="email"]'
  )->setValue($user->getEmail());
  $session->getPage()->find(
    'css',
    'input[name="password"]'
  )->setValue($user->getPassword());

  /*Click to connect*/
  $session->getPage()->find(
    'css',
    'input[type="submit"]'
  )->click();

  //The user is redirect to the home page
  checkUrl('http://localhost/kinenveut/?r=home');
}

function disconnect($session)
{
  /*Disconnect*/
  //todo : find a way to click on the disconnect button
  $session->visit('http://localhost/kinenveut/?r=logout');

  //The user is redirect to the login page
  checkUrl('http://localhost/kinenveut/?r=login');
}

/*Add values to DB*/

function createAuction($session, $auction)
{
  checkUrl('http://localhost/kinenveut/?r=auction/create');

  /*Full the form to create an auction*/
  //Object name
  $session->getPage()->find(
    'css',
    'input[name="name"]'
  )->setValue($auction->getName());
  //Base Price
  $session->getPage()->find(
    'css',
    '#basePrice'
  )->setValue($auction->getBasePrice());
  //Reserve Price
  $session->getPage()->find(
    'css',
    '#reservePrice'
  )->setValue($auction->getReservePrice());
  //Category
  $session->getPage()->find(
    'css',
    '#categoryId'
  )->selectOption($auction->getCategoryId());
  //Duration
  $session->getPage()->find(
    'css',
    '#duration'
  )->setValue($auction->getDuration());
  //Privacy
  $session->getPage()->find(
    'css',
    '#privacyId'
  )->selectOption($auction->getPrivacyId());
  //Description
  $session->getPage()->find(
    'css',
    '#description'
  )->setValue($auction->getDescription());

  /*Submit the form*/
  //Submit
  $session->getPage()->find(
    'css',
    'input[type="submit"]'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=home');
}

/*Big functions*/

function subscribeAndValidateAUser(UserModel $user) : ?int
{
  $session = Universe::getUniverse()->getSession();

  $userAdmin = new UserModel();
  $userAdmin
        ->setEmail('admin@kinenveut.fr')
        ->setPassword('password');

  visitRegistrationPage($session);
  suscribe($session, $user);

  if ($user->getId() == null || $user->getId() < 1) {
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userFromDB = $userBo->selectUserByEmail($user->getEmail());
    $user->setId($userFromDB->getId());
  }

  /*Connection as Admin*/
  connect($session, $userAdmin);
  visitUserManagment($session);

  //Todo : search by name
  /*Click to accept the prevent created user*/
  $href = '?r=userManagement/validate&id=' . $user->getId();
  $session->getPage()->find(
    'css',
    'a[href="' . $href . '"]'
  )->click();

  checkUrl('http://localhost/kinenveut/?r=userManagement/validate&id=' . $user->getId());

  disconnect($session);

  Universe::getUniverse()->setToDelete(['users' => [$user]]);

  return $user->getId();
}

function createAuctionForUser(AuctionModel $auction, UserModel $user) : ?int
{
  /*Be careful, you are supposed to be connected with $user*/

  $session = Universe::getUniverse()->getSession();

  $userAdmin = new UserModel();
  $userAdmin
        ->setEmail('admin@kinenveut.fr')
        ->setPassword('password');

  visitCreateAuction($session);
  createAuction($session, $auction);

  disconnect($session);
  /*Connection as Admin*/
  connect($session, $userAdmin);
  visitAuctionManagement($session);

  //Todo : use the name to find the button :)
  $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
  $userAuctions = $auctionBo->selectAllAuctionsBySellerId($user->getId());

  if (count($userAuctions) == 1) {
    $auctionId = $userAuctions[0]->getId();
    $auction->setId($auctionId);
  } else {
    //here you must search for the auction using name and description :)
    throw new Exception('A problem happenned while create an auction (the user can\'t have more than 1 auction for now');
  }

  /*Click to accept the prevent created auction*/
  $url = 'http://localhost/kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
  $session->visit($url);
  checkUrl($url);

  disconnect($session);

  return $auction->getId();
}
