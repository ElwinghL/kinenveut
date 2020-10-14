<?php include_once 'src/view/page-header.php' ?>

<?php
$categoryList = $data['categoryList'];
$dataError = isset($data['errors']) ? $data['errors'] : null;
$dataValue = isset($data['values']) ? $data['values'] : null;
?>

<div class="container">
  <h2>
    Créer une enchère
  </h2>

  <div class="col-12">
    <form action="?r=auction/saveObjectAuction" method="post" class="<?php if (!empty($dataError)) {
  echo 'was-validated';
} ?>">

      <!--Titre-->
      <div class="form-group col-md-3">
        <label for="name">Titre</label>
        <input class="form-control" name="name" type="text" id="name" value="<?php if (isset($dataValue['name'])) {
  echo $dataValue['name'];
} ?>" placeholder="" maxlength="255" required />

        <?php if (isset($dataError['name'])) : ?>
          <div class="invalid-feedback d-block">
            <?php echo $dataError['name'] ?>
          </div>
        <?php endif; ?>
      </div>

      <!--Prix-->
      <div class="form-group col-md-3">
        <label for="basePrice">Prix de base
          <span title="Prix de départ">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
              <circle cx="8" cy="4.5" r="1" />
            </svg>
          </span>
        </label>
        <input class="form-control" name="basePrice" type="number" id="basePrice" value="<?php echo isset($dataValue['basePrice']) ? $dataValue['basePrice'] : 0; ?>" placeholder="0" min="0" step="1" />
        <?php if (isset($dataError['basePrice'])) : ?>
          <div class="invalid-feedback d-block"><?php echo $dataError['basePrice']; ?></div>
        <?php endif; ?>

        <label for="reservePrice">Prix de réserve
          <span title="Prix minimum à atteindre : L'article ne sera pas vendu s'il n'atteint pas ce prix">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
              <circle cx="8" cy="4.5" r="1" />
            </svg>
          </span>
        </label>
        <input class="form-control" name="reservePrice" type="number" id="reservePrice" value="<?php echo isset($dataValue['reservePrice']) ? $dataValue['reservePrice'] : 0; ?>" placeholder="0" min="0" step="1"/>
        <?php if (isset($dataError['reservePrice'])) : ?>
          <div class="invalid-feedback d-block"><?php echo $dataError['reservePrice'] ?></div>
        <?php endif; ?>
      </div>

      <!--Catégories-->
      <div class="form-group col-md-3">
        <label for="categoryId">Catégorie</label>
        <select class="form-control" name="categoryId" id="categoryId">
          <?php if (sizeof($categoryList) > 0) : ?>
            <?php foreach ($categoryList as $oneCategory) : ?>
              <option value="<?= $oneCategory->getId(); ?>"><?= $oneCategory->getName(); ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <!--Durée-->
      <div class="form-group col-md-3">
        <label for="duration">Durée (Nombre de jours)</label>
        <input class="form-control" type="number" name="duration" id="duration" value="<?php echo isset($dataValue['duration']) ? $dataValue['duration'] : '7'; ?>" min="1" max="30" placeholder="Durée" step="1" required />
        <?php if (isset($dataError['duration'])) : ?>
          <div class="invalid-feedback d-block"><?php echo $dataError['duration'] ?></div>
        <?php endif; ?>
      </div>

      <!--Confidentialité-->
      <div class="form-group col-md-3">
        <label for="privacyId">Confidentialité</label>
        <select class="form-control" name="privacyId" id="privacyId">
          <option value="0" selected>Libre</option>
          <option value="1">Privée</option>
          <option value="2">Confidentielle</option>
        </select>
      </div>

      <!--Description-->
      <div class="form-group col-md-5">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control" rows="4" cols="50"><?php echo isset($dataValue['description']) ? $dataValue['description'] : ''; ?></textarea>
        <?php if (isset($dataError['description'])) : ?>
          <div class="invalid-feedback d-block">
            <?php echo $dataError['description'] ?>
          </div>
        <?php endif; ?>
      </div>

      <!--Boutons-->
      <div class="form-group col-md-3">

        <input class="btn btn-primary" type="submit" name="createAuction" id="createAuction" value="Valider" />
      </div>
    </form>
  </div>
</div>