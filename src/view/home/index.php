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
    <div class="col-lg-12">
        <strong class="col-lg-2">Catégorie</strong>
        <div class="col-lg-4">
            <select class="form-control">
                <option>Toute catégorie</option>
                <option>Smartphones</option>
                <option>Voitures</option>
                <option>Maisons</option>
            </select>
        </div>
        <div class="col-lg-12">
            <strong class="col-lg-2">Type d'offres</strong>
            <div class="col-lg-4">
                <select class="form-control">
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
                <?php
                    if (isset($data) && isset($data['auctions'])) {
                      foreach ($data['auctions'] as $auction) {
                        echo '<div class="col-md-3 col-sm-6">',
                                '<span class="thumbnail text-center">',
                                    '<h4 class="text-danger">' . $auction['name'] . '</h4>',
                                    '<p>Expiration : ' . $auction['endDate'],
                                    '<hr class="line">',
                                    '<div class="row">',
                                        '<div class="col-md-6 col-sm-6">',
                                            '<button type="button" class="btn btn-link">' . $auction['basePrice'] . '€</button>',
                                        '</div>',
                                        '<div class="col-md-6 col-sm-6">',
                                            '<button class="btn btn-danger right">Enchérir</button>',
                                        '</div>',
                                    '</div>',
                                '</span>',
                            '</div>';
                      }
                    }
                ?>
  		<!-- END PRODUCTS -->
	</div>
</div>