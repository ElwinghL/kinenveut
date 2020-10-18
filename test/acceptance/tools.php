<?php

function checkUrl($session, $expectedUrl)
{
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
  if (!strpos($currentUrl, $expectedUrl)) {
    throw new Exception('The current url "' . $currentUrl . '" do not contain "' . $expectedUrl . '"');
  }
}

/*Visit pages / Click on button*/

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

  $url = 'http://localhost/kinenveut/?r=auction/create';
  checkUrl($session, $url);
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

  $userDao = App_DaoFactory::getFactory()->getUserDao();
  $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
  $expectedUrl = 'http://localhost/kinenveut/?r=auction/sells/&userId=' . $user->getId();

  if ($session->getStatusCode() !== 200) {
    throw new Exception('status code is not 200');
  }
  if ($session->getCurrentUrl() !== $expectedUrl) {
    throw new Exception('url is not ' . $expectedUrl);
  }
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

  $url = 'http://localhost/kinenveut/?r=auctionManagement';
  checkUrl($session, $url);
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

  $url = 'http://localhost/kinenveut/?r=userManagement';
  checkUrl($session, $url);
}

function visitRegistrationPage($session)
{
  /*Go to suscribe page*/
  $session->getPage()->find(
    'css',
    'a[href="?r=registration"]'
  )->click();

  $url = 'http://localhost/kinenveut/?r=registration';
  checkUrl($session, $url);
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
  $url = 'http://localhost/kinenveut/?r=registration';
  checkUrl($session, $url);

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

  $url = 'http://localhost/kinenveut/?r=login';
  checkUrl($session, $url);
}

function connect($session, UserModel $user)
{
  $url = 'http://localhost/kinenveut/?r=login';
  checkUrl($session, $url);

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

  $url = 'http://localhost/kinenveut/?r=home';
  checkUrl($session, $url);
}

function disconnect($session)
{
  /*Disconnect*/
  //todo : find a way to click on the disconnect button
  $session->visit('http://localhost/kinenveut/?r=logout');

  //The user is redirect to the login page

  $url = 'http://localhost/kinenveut/?r=login';
  checkUrl($session, $url);
}

/*Add values to DB*/

function createAuction($session, $auction)
{
  $url = 'http://localhost/kinenveut/?r=auction/create';
  checkUrl($session, $url);

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

  $url = 'http://localhost/kinenveut/?r=home';
  checkUrl($session, $url);
}

/*Delete Universe elements functions*/

function deleteUserUniverse()
{
  $canDelete = Universe::getUniverse()->getCanDelete();
  $userDao = App_DaoFactory::getFactory()->getUserDao();
  if (isset($canDelete['user'])) {
    $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
    if ($user != null) {
      $isAdmin = $user->getIsAdmin();
      if ($isAdmin == false) {
        $userDao->deleteUser($user->getId());
      }
    }
    unset($canDelete['user']);
    Universe::getUniverse()->setCanDelete($canDelete);
  }
}

function deleteUser2Universe()
{
  $canDelete = Universe::getUniverse()->getCanDelete();
  $userDao = App_DaoFactory::getFactory()->getUserDao();

  if (isset($canDelete['user2'])) {
    $user2 = $userDao->selectUserByEmail(Universe::getUniverse()->getUser2()->getEmail());
    if ($user2 != null) {
      $isAdmin2 = $user2->getIsAdmin();
      if ($isAdmin2 == false) {
        $userDao->deleteUser($user2->getId());
      }
    }
    unset($canDelete['user2']);
    Universe::getUniverse()->setCanDelete($canDelete);
  }
}

function deleteUser3Universe()
{
  $canDelete = Universe::getUniverse()->getCanDelete();
  $userDao = App_DaoFactory::getFactory()->getUserDao();

  if (isset($canDelete['user23'])) {
    $user3 = $userDao->selectUserByEmail(Universe::getUniverse()->getUser3()->getEmail());
    if ($user3 != null) {
      $isAdmin2 = $user3->getIsAdmin();
      if ($isAdmin2 == false) {
        $userDao->deleteUser($user3->getId());
      }
    }
    unset($canDelete['user3']);
    Universe::getUniverse()->setCanDelete($canDelete);
  }
}
function deleteAuctionUniverse()
{
  if (isset($canDelete['auctions'])) {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $userDao = App_DaoFactory::getFactory()->getUserDao();

    $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());

    if ($user != null) {
      $userAuctions = $auctionDao->selectAllAuctionsBySellerId($user->getId());
      foreach ($userAuctions as $auction) {
        $auctionDao->deleteAuctionById($auction->getId());
      }
    }
    unset($canDelete['auctions']);
  }
}
