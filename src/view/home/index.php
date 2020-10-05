<?php
  $categoryList = $data['categoryList'];
  $auctionList = $data['auctionList'];
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
    <div class="row search-bar-custom">
        <h2>Recherche</h2>
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <input type="text" class="search-query form-control" placeholder="Smartphone, enceinte connectée, PS4..." />
                <span class="input-group-btn">
                    <button class="btn btn-danger" type="button">
                        <span class=" glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="row categories-custom">
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Catégorie</label>
                <select id="category" class="form-control">
                    <option selected>Toutes</option>
                    <?php if (sizeof($categoryList) > 0):?>
                        <?php foreach ($categoryList as $oneCategory): ?>
                            <option value="<?php echo $oneCategory->getId(); ?>">
                                <?php echo $oneCategory->getName(); ?>
                            </option>
                        <?php endforeach;?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="privacy">Type d'offres</label>
                <select id="category" class="form-control">
                    <option>Offres publiques</option>
                    <option>Offres privées</option>
                    <option>Offres confidentielles</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="container auctions-list-custom">
    <div class="row">
        <!-- BEGIN PRODUCTS -->
        <?php foreach ($auctionList as $auction) : ?>
            <a class="col-md-3 col-sm-6 auction-custom" href=<?php echo '?r=bid/index&auctionId=' . $auction->getId() ?>>
                <div class="thumbnail text-center">
                    <h4 class="text-danger auction-title-custom"> <?php echo $auction->getName(); ?> </h4>
                    <p>Expiration : <?php echo date('d/m/Y h:m', strtotime($auction->getStartDate() . ' + ' . $auction->getDuration() . ' days')); ?></p>
                    <hr class="line" />
                    <div class="row">
                        <div class="col-md-12">
                        <?php if ($auction->getBestBid()->getbidPrice() !== null) {
  echo '<p class="bg-danger">Dernière offre : ' . $auction->getBestBid()->getbidPrice() . '€</p>';
} else {
  echo '<p class="bg-danger">Prix de base : ' . $auction->getBasePrice() . '€</p>';
} ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        <!-- END PRODUCTS -->
    </div>
</div>