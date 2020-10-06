<div class="container page-header-custom">
    <div class="row row-vertically-centered">
        <div class="col-md-10">
            <a href="?r=home">
                <img src="resources/logo.png" width="158" height="143" alt="logo"/>
            </a>
        </div>
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="?r=auction/create">Vendre</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?r=account&userId=<?= isset($_SESSION['userId']) ? $_SESSION['userId'] : '1';?>">Mon compte</a>
                            <a class="dropdown-item" href="?r=auction/bids&userId=<?= isset($_SESSION['userId']) ? $_SESSION['userId'] : '1';?>">Mes enchères</a>
                            <a class="dropdown-item" href="?r=auction/sells/&userId=<?= isset($_SESSION['userId']) ? $_SESSION['userId'] : '1';?>">Mes ventes</a>
                            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) : ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?r=user">Gestion des utilisateurs</a>
                                <a class="dropdown-item" href="?r=auctionManagement">Gestion des enchères</a>
                                <a class="dropdown-item" href="?r=categorie">Gestion des catégories</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-light" onclick="location.href='?r=logout'" title="Déconnexion">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
