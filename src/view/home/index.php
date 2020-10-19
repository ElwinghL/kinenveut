<?php
$categoryList = $data['categoryList'];
$auctionList = $data['auctionList'];

$selectedCategory = isset($data['selectedCategory']) ? $data['selectedCategory'] : -1;
$selectedOfferType = isset($data['selectedOfferType']) ? $data['selectedOfferType'] : -1;
$searchInput = isset($data['searchInput']) ? $data['searchInput'] : '';
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container search-custom">
  <h2>Recherche</h2>
  <form action="?r=home/search" method="post">
    <div class="row categories-custom">
      <div class="col-md-6">
        <div class="form-group">
          <label for="category">Catégories</label>
          <select id="categoryId" name="categoryType" class="form-control">
            <option value="-1">Toutes les catégories</option>
            <?php if (sizeof($categoryList) > 0) : ?>
              <?php foreach ($categoryList as $oneCategory) : ?>
                <option value="<?php echo $oneCategory->getId(); ?>" <?php if ($selectedCategory == $oneCategory->getId()) {
  echo 'selected';
} ?>>
                  <?php echo $oneCategory->getName(); ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="privacy">Types d'offres</label>
          <select id="privacyId" name="offerType" class="form-control">
            <option value="-1" <?php if ($selectedOfferType == -1) {
  echo 'selected';
} ?>>Tous les types d'offres</option>
            <option value="0" <?php if ($selectedOfferType == 0) {
  echo 'selected';
} ?>>Offres publiques</option>
            <option value="1" <?php if ($selectedOfferType == 1) {
  echo 'selected';
} ?>>Offres privées</option>
            <option value="2" <?php if ($selectedOfferType == 2) {
  echo 'selected';
} ?>>Offres confidentielles</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="input-group col-md-12">
        <input name="searchInput" type="text" class="search-query form-control" value="<?php echo $searchInput ?>" placeholder="Smartphone, enceinte connectée, PS4..." />
        <span class="input-group-btn">
          <input class="btn btn-danger search-button-custom" type="submit" name="searchButton" value="Rechercher"/>
        </span>
      </div>
    </div>
  </form>
</div>

<div class="container auctions-list-custom">
  <div class="row">
    <!-- BEGIN PRODUCTS -->
    <?php if (isset($auctionList) && sizeof($auctionList)>0) : ?>
      <?php foreach ($auctionList as $auction) : ?>
        <div class="col-md-3 col-sm-6">
          <a class="auction-custom card card-product" href=<?php echo '?r=bid/index&auctionId=' . $auction->getId() ?>>
            <div class="thumbnail text-center">
                <div style="text-align: right;">
                    <?php include 'src/view/common/privacyBadge.php';?>
                </div>
              <h4 class="text-danger auction-title-custom"> <?php echo $auction->getName(); ?> </h4>
              <p>Expiration : <?php echo dateTimeFormat($auction->getEndDate()); ?></p>
              <hr class="line" />
              <div class="row">
                <div class="col-md-12">
                  <?php if ($auction->getBestBid()->getbidPrice() !== null) {
  echo '<p class="auction-price-custom">Dernière offre : ' . $auction->getBestBid()->getbidPrice() . '€</p>';
} else {
  echo '<p class="auction-price-custom">Prix de base : ' . $auction->getBasePrice() . '€</p>';
} ?>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
        <i>
            Oh bah ça alors... Il semblerait qu'il n'ait aucune enchère en cours !
            <br/>
            Cliquez  sur "<b>Menu</b>"/"<b>Vendre</b>" pour créer une enchère.
        </i>
        </div>
    <?php endif; ?>
    <!-- END PRODUCTS -->
  </div>
</div>
