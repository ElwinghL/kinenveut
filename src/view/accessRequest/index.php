<?php include_once 'src/view/page-header.php' ?>

<?php
$auctionAccessSateList = $data['auctionAccessStateList'];
?>

<div class="container">
  <h2>
    Demandes en attente
  </h2>

  <div class="col-12">
    <?php if (sizeof($auctionAccessSateList) > 0) : ?>
      <ul class="list-group">
        <?php foreach ($auctionAccessSateList as $oneAuctionAccessSate) : ?>
          <li id="AuctionAccessSate_<?php echo $oneAuctionAccessSate->getId(); ?>" class="list-group-item">
            <?php $auction = $oneAuctionAccessSate->getAuction(); ?>
            <?php $bidder = $oneAuctionAccessSate->getBidder(); ?>
            <div class="col-md-10 mr-0 float-left">
              <b><?php echo $bidder->getFirstName() . ' ' . $bidder->getLastName(); ?></b>
              a demandé à pouvoir accéder à l'enchère "<?php echo $auction->getName(); ?>".
            </div>
            <div class="col-md- mr-0 float-right">
              <a href="?r=accessRequest/accept&aasid=<?php echo $oneAuctionAccessSate->getId(); ?>" class="btn btn-success">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
                </svg>
              </a>
              <a href="?r=accessRequest/refuse&aasid=<?php echo $oneAuctionAccessSate->getId(); ?>" class="btn btn-danger">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
              </a>
            </div>

          <?php endforeach; ?>
      </ul>
    <?php else : ?>
      <i>Vous n'avez aucune demande en attente.</i>
    <?php endif; ?>
  </div>
</div>
