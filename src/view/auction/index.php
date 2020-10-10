<?php
$titlePage = isset($data['titlePage']) ? $data['titlePage'] : 'Liste d\'enchères';
$auctionList = isset($data['auctionList']) ? $data['auctionList'] : '';
$pageUser = ($titlePage == 'Mes ventes') ? 1 : 0;

include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>
    <?php echo $titlePage ?>
    <a href=<?php echo '?r=auction/create' ?>>
      <button type="button" class="btn btn-primary btn-add">+</button></a>
  </h2>

  <?php if (isset($data['auctionList'])) { ?>
    <div>
      <div class="col-md-12 center-div">
        <ul class="list-group title-line">
          <li class="list-group-item float head-list">
            <div class="col-md-5 mr-0 float-left">Nom</div>
            <div class="col-md-6 mr-0 float-left">Prix
            </div>
            <div class="col-md- mr-0">Etat</div>
          </li>
        </ul>
      </div>

      <div class="col-md-12">
        <?php if (sizeof($auctionList) > 0) : ?>
          <ul class="list-group">
            <?php foreach ($auctionList as $auction) : ?>
              <li id="category_<?php echo $auction->getId(); ?>" class="list-group-item float">
                <div class="col-md-5 mr-0 float-left">
                  <a href=<?php echo '?r=bid/index&auctionId=' . $auction->getId() ?>>
                    <?php echo $auction->getName(); ?>
                  </a>
                </div>
                <div class="col-md-4 mr-0 float-left">
                    <?php $minPrice = (($auction->getBestBid()->getBidPrice() != null) && ($auction->getBestBid()->getBidPrice() != null)) ? $auction->getBestBid()->getBidPrice() : $auction->getBasePrice();?>
                    <?php $isWinning = ($_SESSION['userId'] == $auction->getBestBid()->getBidderId());?>
                    <?php if ($_SESSION['userId'] != $auction->getSellerId()):?>
                        <span class="text-<?php echo($isWinning) ? 'success' : 'danger';?>">
                            <?php echo $minPrice . ' €';?>
                        </span>
                    <?php else:?>
                        <?php echo $minPrice . '€'; ?>
                    <?php endif;?>
                </div>
                <div class="col-md- mr-0 float-right">
                  <?php
                  switch ($auction->getAuctionState()) {
                    case 0:
                      if ($pageUser) { ?>
                        <a href=<?php echo '?r=auction/cancel&auctionId=' . $auction->getId() ?>>
                          <button type="button" class="btn btn-primary btn-ca">Annuler</button></a>
                      <?php } else {
                        echo 'En attente de validation';
                      }
                      break;
                    case 1:
                      if ($pageUser) { ?>
                        <a href=<?php echo '?r=auction/abort&auctionId=' . $auction->getId() ?>>
                          <button type="button" class="btn btn-primary btn-ab">Clôturer</button></a>
                        <a href=<?php echo '?r=auction/cancel&auctionId=' . $auction->getId() ?>>
                          <button type="button" class="btn btn-primary btn-ca">Annuler</button></a>
                  <?php } else {
                        echo '<span class="badge badge-success">En cours</span>';
                      }
                      break;
                    case 2:
                      echo '<span class="badge badge-danger">Annulée</span>';
                      break;
                    case 3:
                      echo '<span class="badge badge-secondary">Clôturée</span>';
                      break;
                    case 4:
                      echo '<span class="badge badge-secondary">Terminée</span>';
                      break;
                    case 5:
                      echo '<span class="badge badge-dark">Refusée</span>';
                      break;
                    case 6:
                      echo '<span class="badge badge-dark">Bannie</span>';
                      break;
                  }
                  ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
      <?php endif;
      } else {
        echo "Il n'y a aucune enchère à consulter";
      }
      ?>
      </div>
    </div>