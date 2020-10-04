<!--action :)-->
<?php include_once 'src/view/page-header.php' ?>

<?php
$categoryList = $data['categoryList'];

if (isset($_SESSION['auctionData'])) {
  if (isset($_SESSION['auctionData']['errors'])) {
    $errors = $_SESSION['auctionData']['errors'];
    $name = $_SESSION['auctionData']['name'];
    $description = $_SESSION['auctionData']['description'];
    $basePrice = $_SESSION['auctionData']['basePrice'];
    $reservePrice = $_SESSION['auctionData']['reservePrice'];
    $startDate = $_SESSION['auctionData']['startDate'];
    $duration = $_SESSION['auctionData']['duration'];
  }
  unset($_SESSION['auctionData']);
}
?>

<div class="container">
    <h2>
        Gestion des catégories
    </h2>

    <div class="col-12">
            <form action="?r=auction/saveObjectAuction" method="post">

                <div class="form-group col-md-10">

                    <label for="name">Objet <i style="color:red;"><?php if (isset($errors['name'])) {
  echo 'Erreur : ' . $errors['name'];
}
                            echo(''); ?></i></label>
                    <input class="form-control" name="name" type="text" id="name" value="<?php if (isset($name)) {
                              echo $name;
                            }
                    echo(''); ?>" placeholder="Objet" maxlength="255" required/>

                    <br/>

                    <label for="description">Description <i style="color:red;"><?php if (isset($errors['description'])) {
                      echo 'Erreur : ' . $errors['description'];
                    }
                            echo(''); ?></i> </label>
                    <input class="form-control" name="description" type="text" id="description" value="<?php if (isset($description)) {
                              echo $description;
                            }
                    echo(''); ?>" placeholder="Description" maxlength="255"/>

                    <br/>

                    <label for="basePrice">Prix de départ <i style="color:red;"><?php if (isset($errors['basePrice'])) {
                      echo 'Erreur : ' . $errors['basePrice'];
                    }
                            echo(''); ?></i> </label>
                    <input class="form-control" name="basePrice" type="number" id="basePrice" value="<?php if (isset($basePrice)) {
                              echo $basePrice;
                            }
                    echo(''); ?>" placeholder="" step="any" required/>

                    <br/>

                    <label for="reservePrice">Prix de réserve</label>
                    <input class="form-control" name="reservePrice" type="number" id="reservePrice" value="<?php if (isset($reservePrice)) {
                      echo $reservePrice;
                    }
                    echo(''); ?>" placeholder="" step="any"/>

                    <br/>


                    <!--                    <label for="pictureLink">Image</label>-->
                    <!--                    <input class="form-control" name="pictureLink" type="file" id="pictureLink" value=""/>-->

                    <label for="startDate">Date de début</label>
                    <input class="form-control" type="date" name="startDate" id="startDate" value="<?php if (isset($startDate)) {
                      echo $startDate;
                    }
                    echo(''); ?>" placeholder="Date de début" min=<?php echo date('Y-m-d')?> max=<?php echo date('Y-m-d', strtotime('+7 days'))?> />

                    <br/>

                    <label for="duration">Durée (jours)</label>
                    <input class="form-control" type="number" name="duration" id="duration" value="<?php if (isset($duration)) {
                      echo $duration;
                    }
                    echo(''); ?>" min="0" max ="30" placeholder="Durée" required/>

                    <br/>

                    <label for="privacyId">Confidentialité</label>
                    <select class="form-control" name="privacyId" id="privacyId"required/>
                    <option value="1" selected>Libre</option>
                    <option value="2">Privée</option>
                    <option value="3" >Confidentielle</option>
                    </select>

                    <br/>

                    <label for="categoryId">Catégories</label>

                    <select class="form-control" name="categoryId" id="categoryId">
                        <?php if (sizeof($categoryList) > 0):
                            foreach ($categoryList as $oneCategory): ?>
                                <option value="<?= $oneCategory->getId(); ?>"><?= $oneCategory->getName(); ?></option>
                            <?php endforeach;
                        endif; ?>

                    </select>

                    <br/>

                    <input class="btn btn-primary" type="submit" name="createAuction" id="createAuction" value="Valider"/>
                    <input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Annuler"/>
                </div>
            </form>
        </div>
    </div>
