<?php

function checkUrl($expectedUrl)
{
  $expectedUrl = $_ENV['path'] . $expectedUrl;
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
  $expectedUrl = $_ENV['path'] . $expectedUrl;
  $currentUrl = $session->getCurrentUrl();

  if ($session->getStatusCode() !== 200) {
    throw new Exception('status code is not 200');
  }
  if (strpos($currentUrl, $expectedUrl) === false) {
    throw new Exception('The current url "' . $currentUrl . '" do not contain "' . $expectedUrl . '"');
  }
}

/*Visit pages / Click on button*/

function clickOnMenu($session)
{
  $button = $session->getPage()->find(
    'css',
    '#dropdownMenuButton'
  );

  if ($button == null) {
    throw new Exception('The menu button you\'re searching doesn\'t exist');
  }

  $button->click();
}

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

  checkUrlPartial($session, 'kinenveut/?r=account&userId=');
}

function visitCreateAuction($session)
{
  clickOnMenu($session);

  $button = $session->getPage()->find(
    'css',
    '#menuCreateAuction'
  );
  if ($button == null) {
    throw new Exception('The create auction button you\'re searching doesn\'t exist');
  }
  $button->click();

  checkUrl('kinenveut/?r=auction/create');
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
  checkUrl('kinenveut/?r=auction/sells/&userId=' . $user->getId());
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
  checkUrl('kinenveut/?r=auction/bids&userId=' . $user->getId());
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

  checkUrl('kinenveut/?r=auctionManagement');
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

  checkUrl('kinenveut/?r=userManagement');
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

  checkUrl('kinenveut/?r=categorie');
}

function visitRegistrationPage($session)
{
  /*Go to suscribe page*/
  $button = $session->getPage()->find(
    'css',
    'a[href="?r=registration"]'
  );

  if ($button == null) {
    throw new Exception('The registration link you\'re searching doesn\'t exist');
  }
  $button->click();

  checkUrl('kinenveut/?r=registration');
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

  checkUrlPartial($session, 'kinenveut/?r=accessRequest');
}

/*Suscribe & Connection functions*/

function suscribe($session, UserModel $localUser)
{
  checkUrl('kinenveut/?r=registration');

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
  $button = $session->getPage()->find(
    'css',
    'input[type="submit"]'
  );
  if ($button == null) {
    throw new Exception('There is no submit button on this page');
  }
  $button->click();

  //The user is redirect to the login page
  checkUrl('kinenveut/?r=login');
}

function connect($session, UserModel $user)
{
  checkUrl('kinenveut/?r=login');

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
  checkUrl('kinenveut/?r=home');
}

function disconnect()
{
  /*Disconnect*/
  //todo : find a way to click on the disconnect button
  visiteUrl('kinenveut/?r=logout');

  //The user is redirect to the login page
  checkUrl('kinenveut/?r=login');
}

/*Add values to DB*/

function createAuction($session, $auction)
{
  checkUrl('kinenveut/?r=auction/create');

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

  checkUrl('kinenveut/?r=home');
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
  $button = $session->getPage()->find(
    'css',
    'a[href="' . $href . '"]'
  );

  if ($button == null) {
    throw new Exception('The link you\' searching doesn\'t exist');
  }
  $button->click();

  checkUrl('kinenveut/?r=userManagement/validate&id=' . $user->getId());

  disconnect();

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

  disconnect();
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
  $url = 'kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
  visiteUrl($url);
  checkUrl($url);

  disconnect();

  return $auction->getId();
}

function visiteUrl($url)
{
  $session = Universe::getUniverse()->getSession();
  $session->visit($_ENV['path'] . $url);
}
