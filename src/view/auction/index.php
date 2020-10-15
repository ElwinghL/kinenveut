<?php
    $titlePage = isset($data['titlePage']) ? $data['titlePage'] : 'Liste d\'enchères';
    $auctionList = isset($data['auctionList']) ? $data['auctionList'] : '';
    $pageUser = ($titlePage == 'Mes ventes') ? 1 : 0;
?>
<?php include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>
    <?php echo $titlePage ?>
      <?php if ($pageUser == true):?>
          <a href="<?php echo '?r=auction/create' ?>">
              <button type="button" class="btn btn-primary btn-add">+</button>
          </a>
      <?php endif;?>
  </h2>

    <?php if (isset($data['auctionList'])): ?>
        <div>
            <div class="col-md-12 center-div">
                <ul class="list-group title-line">
                    <li class="list-group-item float head-list">
                        <div class="col-md-5 mr-0 float-left">Nom</div>
                        <div class="col-md-6 mr-0 float-left">Prix</div>
                        <div class="col-md- mr-0">Etat</div>
                    </li>
                </ul>
            </div>

            <div class="col-md-12">
                <?php if (sizeof($auctionList) > 0) : ?>
                    <!--Auction List-->
                    <ul class="list-group">
                        <?php foreach ($auctionList as $auction) : ?>

                            <!--One Auction-->
                            <li id="category_<?php echo $auction->getId(); ?>" class="list-group-item float">

                                <div class="col-md-5 mr-0 float-left">
                                    <a href="<?='?r=bid/index&auctionId=' . $auction->getId()?>">
                                        <?=$auction->getName();?>
                                    </a>
                                </div>

                                <div class="col-md-4 mr-0 float-left">
                                    <?php $minPrice = (($auction->getBestBid()->getBidPrice() != null) && ($auction->getBestBid()->getBidPrice() != null)) ? $auction->getBestBid()->getBidPrice() : $auction->getBasePrice();?>
                                    <?php $isWinning = ($_SESSION['userId'] == $auction->getBestBid()->getBidderId());?>
                                    <?php if ($_SESSION['userId'] != $auction->getSellerId()):?>
                                        <span class="text-<?php echo($isWinning) ? 'success' : 'danger';?>">
                                            <?=$minPrice . ' €';?>
                                        </span>
                                    <?php else:?>
                                        <?=$minPrice . ' €'; ?>
                                    <?php endif;?>
                                </div>

                                <div class="col-md- mr-0 float-right">
                                    <?php switch ($auction->getAuctionState()):
                                        case 0:?>
                                            <?php if ($pageUser): ?>
                                                <a href="<?= '?r=auction/cancel&auctionId=' . $auction->getId() ?>">
                                                    <button type="button" class="btn btn-primary btn-ca">Annuler</button>
                                                </a>
                                            <?php else:?>
                                                En attente de validation
                                            <?php endif; ?>
                                            <?php break;?>
                                        <?php case 1: ?>
                                            <?php if ($pageUser): ?>
                                                <?php if($auction->getBestBid() != null && $auction->getBestBid()->getBidPrice() >= $auction->getReservePrice() && $auction->getBestBid()->getBidPrice() > 0):?>
                                                    <a href="<?= '?r=auction/abort&auctionId=' . $auction->getId() ?>">
                                                        <button class="btn btn-primary">Clôturer</button>
                                                    </a>
                                                <?php else:?>
                                                    <a href="<?= '?r=auction/abort&auctionId=' . $auction->getId() ?>"
                                                    title="Vous ne pouvez pas clôturer cette enchère car elle n'a pas atteint son prix de réserve">
                                                        <button class="btn btn-primary" disabled>Clôturer</button>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?= '?r=auction/cancel&auctionId=' . $auction->getId() ?>">
                                                    <button type="button" class="btn btn-primary btn-ca">Supprimer</button>
                                                </a>
                                            <?php else: ?>
                                                <span class="badge badge-success">En cours</span>
                                            <?php endif; ?>
                                            <?php break; ?>
                                        <?php case 2: ?>
                                            <span class="badge badge-danger">Annulée</span>
                                            <?php break; ?>
                                        <?php case 3:?>
                                            <span class="badge badge-secondary">Clôturée</span>
                                            <?php break; ?>
                                        <?php case 4: ?>
                                            <span class="badge badge-secondary">Terminée</span>
                                            <?php break; ?>
                                        <?php case 5: ?>
                                            <span class="badge badge-dark">Refusée</span>
                                            <?php break; ?>
                                        <?php case 6: ?>
                                            <span class="badge badge-dark">Bannie</span>
                                            <?php break; ?>
                                    <?php endswitch;?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <i>
                        <?php if ($pageUser): ?>
                            Créez une enchère pour la voir ici
                        <?php else: ?>
                            L'utilisateur n'a pas encore créé d'enchère
                        <?php endif; ?>
                    </i>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
    <i>
        <?php if ($pageUser): ?>
            Créez une enchère pour la voir ici
        <?php else: ?>
            L'utilisateur n'a pas encore créé d'enchère
        <?php endif; ?>
    </i>
    <?php endif;?>
</div>