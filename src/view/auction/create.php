<!--action :)-->
<?php include_once 'src/view/page-header.php' ?>

<div class="container">
    <h2>
        Gestion des catégories
    </h2>

    <div class="col-12">
            <form action="?r=auction/saveObjectAuction" method="post" class="<?php if (!empty($data['errors'])) {
  echo 'was-validated';
} ?>">

                <div class="form-group col-md-10">

                    <label for="name">Objet</label>
                    <input class="form-control" name="name" type="text" id="name" value="<?php if (isset($data['values']['name'])) {
  echo $data['values']['name'];
}
                     ?>" placeholder="Objet" maxlength="255" required/>
                                 <?php if (isset($data['errors']['name'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['name'] ?></div>
            <?php endif; ?>

                    <br/>

                    <label for="description">Description</label>
                    <input class="form-control" name="description" type="text" id="description" value="<?php if (isset($data['values']['description'])) {
                       echo $data['values']['description'];
                     }
                     ?>" placeholder="Description" maxlength="255"/>
           <?php if (isset($data['errors']['description'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['description'] ?></div>
            <?php endif; ?>
                    <br/>

                    <label for="basePrice">Prix de départ</label>
                    <input class="form-control" name="basePrice" type="number" id="basePrice" value="<?php if (isset($data['values']['basePrice'])) {
                       echo $data['values']['basePrice'];
                     }
                     ?>" placeholder="" step="any" required/>
           <?php if (isset($data['errors']['basePrice'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['basePrice'] ?></div>
            <?php endif; ?>
                    <br/>

                    <label for="reservePrice">Prix de réserve</label>
                    <input class="form-control" name="reservePrice" type="number" id="reservePrice" value="<?php if (isset($data['values']['reservePrice'])) {
                       echo $data['values']['reservePrice'];
                     }
                     ?>" placeholder="" step="any"/>
           <?php if (isset($data['errors']['reservePrice'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['reservePrice'] ?></div>
            <?php endif; ?>
                    <br/>


                    <!--                    <label for="pictureLink">Image</label>-->
                    <!--                    <input class="form-control" name="pictureLink" type="file" id="pictureLink" value=""/>-->

                    <label for="startDate">Date de début</label>
                    <input class="form-control" type="date" name="startDate" id="startDate" value="<?php if (isset($data['values']['startDate'])) {
                       echo $data['values']['startDate'];
                     }
                     ?>" placeholder="Date de début" min=<?php echo date('Y-m-d')?> max=<?php echo date('Y-m-d', strtotime('+7 days'))?> />
           <?php if (isset($data['errors']['startDate'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['startDate'] ?></div>
            <?php endif; ?>
                    <br/>

                    <label for="duration">Durée (jours)</label>
                    <input class="form-control" type="number" name="duration" id="duration" value="<?php if (isset($data['values']['duration'])) {
                       echo $data['values']['duration'];
                     }
                     ?>" min="0" max ="30" placeholder="Durée" required/>
           <?php if (isset($data['errors']['duration'])) : ?>
              <div class="invalid-feedback"><?php echo $data['errors']['duration'] ?></div>
            <?php endif; ?>
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
