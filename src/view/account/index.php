<?php include_once 'src/view/page-header.php' ?>

<div class="container">
    <h2>Mon compte</h2>
    <div class="row">
        <form action="?r=account/modify" method="post">
          <div class="form-group col-md-12">
            <label for="firstName">Prénom</label>
            <input class="form-control" name="firstName" type="text" id="firstName" value="<?php if (isset($firstName)) {
  echo $firstName;
}
                                                                                            echo(''); ?>" placeholder="" maxlength="100" required />

            <br />
            <label for="lastName">Nom</label>
            <input class="form-control" name="lastName" id="lastName" type="text" value="<?php if (isset($lastName)) {
                                                                                              echo $lastName;
                                                                                            }
                                                                                          echo(''); ?>" placeholder="" maxlength="100" required />
            <br />
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" type="email" value="<?php if (isset($email)) {
                                                                                            echo $email;
                                                                                          }
                                                                                    echo(''); ?>" placeholder="" maxlength="255" required />
            <br />
            <input class="btn btn-primary" name="updateButton" type="submit" value="Mettre à jour" />
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-12">
          <small><a href="?r=account/password">Modifier le mot de passe</a></small>
        </div>
      </div>
</div>