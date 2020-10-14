<?php
$user = isset($data['user']) ? $data['user'] : new UserModel();
?>

<?php include_once 'src/view/page-header.php' ?>

<div class="container">
  <h2>Mon compte</h2>
  <div class="row">
    <form action="?r=account/update&userId=<?= $_SESSION['userId'] ?>" method="post" class="<?php if (!empty($data['errors'])) {
  echo 'was-validated';
} ?>">
      <div class="form-group col-md-12">
        <label for="firstName">Prénom</label>
        <input class="form-control" name="firstName" type="text" id="firstName" value="<?php echo($user->getFirstName()) ?>" placeholder="" maxlength="100" required />
        <br />
        <label for="lastName">Nom</label>
        <input class="form-control" name="lastName" id="lastName" type="text" value="<?php echo($user->getLastName()) ?>" placeholder="" maxlength="100" required />
        <br />
        <label for="email">Email</label>
        <input class="form-control" name="email" id="email" type="email" value="<?php echo($user->getEmail()) ?>" placeholder="" maxlength="255" required />
        <?php if (isset($data['errors']['email'])) : ?>
          <div class="invalid-feedback d-block"><?php echo $data['errors']['email'] ?></div>
        <?php endif; ?>
        <br />
        <input class="btn btn-primary" name="updateButton" type="submit" value="Mettre à jour" />
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-md-12">
      <small><a href="#">Modifier le mot de passe</a></small>
    </div>
  </div>
</div>
