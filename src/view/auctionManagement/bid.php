<?php include_once 'src/view/page-header.php' ?>

<?php
$auction = new AuctionModel();
$auction = (isset($data['auction'])) ? $data['auction'] : new AuctionModel();
$bestBid = ($auction->getBestBid() != null) ? $auction->getBestBid() : new BidModel();
$minPrice = (($bestBid->getBidPrice() != null) && ($bestBid->getBidPrice() != null)) ? $bestBid->getBidPrice() : $auction->getBasePrice;
?>

<div class="container">

  <div class="col-md-2"></div>

  <div class="col-md-8">

    <div class="row">
      <div class="col-md-9">
        <h2><?php echo $auction->getName(); ?></h2>
      </div>
      <div class="col-md-3">
        <small><i>Mis en ligne le <?php echo $auction->getStartDate(); ?></i></small>
      </div>
    </div>

    <div class="row">
      <div class="col-md-9">
        <?php if (strlen($auction->getPictureLink() > 1)) : ?>
          <img src="<?php $auction->getPictureLink(); ?>" width="100%" alt="Photo de l'image associée à l'enchère" />
        <?php endif; ?>
      </div>
      <div class="col-md-3"></div>
    </div>

    <div class="row">
      <form action="" method="post">
        <div class="form-group">
          <div class="col-md-3">
            <input class="form-control" name="bidPrice" type="number" id="bidPrice" value="" min="<?php echo $minPrice + 1; ?>" placeholder="<?php echo $minPrice; ?>" step="any" />
          </div>
          <div class="col-md-2">
            <input class="btn btn-primary" name="makeabid" type="submit" value="Enchérir" />
          </div>
        </div>
      </form>
    </div>

    <div class="row">
      <hr />
    </div>

    <div class="row">
      <h3>Description</h3>
      <p>
        <?php echo $auction->getDescription(); ?>
      </p>
    </div>

    <div class="row">
      <hr />
    </div>

    <div class="row">
      <div class="col-md-9">
        <!--Insérer les informations du vendeur ? (prénom?)-->
      </div>
      <div class="col-md-3"></div>
    </div>

  </div>

  <div class="col-md-2"></div>
</div>
