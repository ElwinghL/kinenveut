<div class="container page-header-custom">
    <div class="row row-vertically-centered">
        <div class="col-md-10">
            <a href="http://localhost/kinenveut/"><img src="resources/logo.png" width="158" height="143"></a>
        </div>
        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Menu
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="?r=account">Mon compte</a></li>
                    <li><a href="?r=auction">Mes enchères</a></li>
                    <li><a href="?r=myAuction">Mes ventes</a></li>

                    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1):?>
                        <li role="separator" class="divider"></li>
                        <li><a href="?r=user">Gestion des utilisateurs</a></li>
                        <li><a href="?r=auction/alerte">Gestion des enchères</a></li>
                        <li><a href="?r=categorie">Gestion des catégories</a></li>
                    <?php endif;?>

                    <li role="separator" class="divider"></li>
                    <li><a href="?r=logout">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>