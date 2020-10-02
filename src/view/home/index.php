<?php
//$categoryList = $data['categoryList'];
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
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Catégorie</label>
                <select id="category" class="form-control">
                    <option>Toute catégorie</option>
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

<div class="container">
    <div class="row">
        <!-- BEGIN PRODUCTS -->
        <?php foreach ($auctionList as $auction) : ?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail text-center">
                    <h4 class="text-danger"> <?php echo $auction->getName(); ?> </h4>
                    <p>Expiration : <?php echo $auction->getDuration() ?></p>
                    <hr class="line" />
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <button type="button" class="btn btn-link"> <?php echo $auction->getBestBid()->getbidPrice(); ?> €</button>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-danger right">Enchérir</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- END PRODUCTS -->
    </div>
</div>