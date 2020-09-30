<?php
  //$categoryList = $data['categoryList'];
  $auctionList = $data['auctionList'];
?>
<div class="container">
    <h2>Accueil</h2>
    <ul>
        <li><a href="?r=registration">Inscription</a></li>
        <li><a href="?r=login">Connexion</a></li>
        <li><a href="?r=account">Mon compte</a></li>
        <li><a href="?r=auction">Mes enchères</a></li>
        <li><a href="?r=auction/create">Créer une enchère</a></li>
        <li><a href="?r=auction/myAuction">Mes ventes</a></li>
        <!--Si c'est un admin-->
        <li><a href="?r=user">Gestion des utilisateurs</a></li>
        <li><a href="?r=auction/alerte">Gestion des enchères</a></li>
        <li><a href="?r=categorie">Gestion des catégories</a></li>
        <!--Endif-->
        <li><a href="#">Déconnexion</a></li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <h2>Recherche</h2>
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <input type="text" class="  search-query form-control" placeholder="Smartphone, enceinte connectée, voiture..." />
                <span class="input-group-btn">
                    <button class="btn btn-danger" type="button">
                        <span class=" glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select id="category" class="form-control">
                <option>Toute catégorie</option>
                <option>Smartphones</option>
                <option>Voitures</option>
                <option>Maisons</option>
            </select>
        </div>
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

<div class="container">
	<div class="row">
    	<!-- BEGIN PRODUCTS -->
        <?php foreach ($auctionList as $auction):?>
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail text-center">
                    <h4 class="text-danger"> <?php echo $auction->getName();?> </h4>
                    <p>Expiration : <?php echo $auction->getDuration()?></p>
                    <hr class="line"/>
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
        <?php endforeach;?>
  		<!-- END PRODUCTS -->
	</div>
</div>