<?php

function visitCreateAuction($session) {
    $session->getPage()->find(
        'css',
        '#dropdownMenuButton'
      )->click();
      $session->getPage()->find(
        'css',
        '#menuCreateAuction'
      )->click();
      if ($session->getStatusCode() !== 200) {
        throw new Exception('status code is not 200');
      }
      if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=auction/create') {
        throw new Exception('url is not "http://localhost/kinenveut/?r=auction/create"');
      }
}

function visitAuctionManagement($session) {
    $session->getPage()->find(
        'css',
        '#dropdownMenuButton'
      )->click();
      $session->getPage()->find(
        'css',
        '#menuAuctionManagement'
      )->click();
      if ($session->getStatusCode() !== 200) {
        throw new Exception('status code is not 200');
      }
      if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=auctionManagement') {
        throw new Exception('url is not "http://localhost/kinenveut/?r=auctionManagement"');
      }
}

?>