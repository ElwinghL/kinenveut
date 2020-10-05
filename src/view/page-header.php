<div class="container page-header-custom">
    <div class="row row-vertically-centered">
        <div class="col-md-10">
            <a href="?"><img src="resources/logo.png" width="158" height="143"></a>
        </div>
        <div class="col-md-2">
            <div class="dropdown" aria-labelledby="dropdownMenu1">
                <div class="row">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Menu
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="?r=auction/create">Vendre</a>
                        <a class="dropdown-item" href="?r=account">Mon compte</a>
                        <a class="dropdown-item" href="?r=auction">Mes enchères</a>
                        <a class="dropdown-item" href="?r=auction/myAuction">Mes ventes</a>
                        <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1):?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="?r=user">Gestion des utilisateurs</a>
                        <a class="dropdown-item" href="?r=auctionManagement">Gestion des enchères</a>
                        <a class="dropdown-item" href="?r=categorie">Gestion des catégories</a>
                        <?php endif;?>
                    </div>
                    <input type="button" class="btn-secondary" value="Déconnexion">
                </div>

            </div>
        </div>
    </div>
</div>
