<?php include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>
    <?php if ($data['category'] === null) : ?>
      Ajouter une catégorie
    <?php else : ?>
      Modifier une catégorie
    <?php endif; ?>
  </h2>
  <div class="row">
    <div class="col-6">
      <form action="?r=categorie/update_data" method="post">
        <div class="form-group d-none">
          <input type="number" name="id" value="<?php if (isset($data['category']['id'])) {
  echo $data['category']['id'];
} ?>">
        </div>
        <div class="form-group">
          <label for="name">Nom de la catégorie</label>
          <input type="text" class="form-control" name="name" value="<?php if (isset($data['category']['name'])) {
  echo $data['category']['name'];
} ?>">
        </div>
        <button type="submit" name="createCategory" class="btn btn-primary">Enregistrer</button>
      </form>
    </div>
  </div>
</div>
