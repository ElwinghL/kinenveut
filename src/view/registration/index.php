<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-2">
    <img class="big-logo" src="resources/logo.png" width="158" height="143">
  </div>
  <div class="col-md-5"></div>
</div>
<div class="container">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Inscription</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <form action="?r=registration/register" method="post">
          <div class="form-group col-md-12">
            <label for="firstName">Prénom</label>
            <input class="form-control" name="firstName" type="text" id="firstName" value="<?php if (isset($data['values']['firstName'])) {
  echo $data['values']['firstName'];
} ?>" maxlength="100" required />
            <?php if (isset($data['errors']['firstName'])) : ?>
              <div class="invalid-feedback"><?php $data['errors']['firstName'] ?></div>
            <?php endif; ?>
            <br />
            <label for="lastName">Nom</label>
            <input class="form-control" name="lastName" id="lastName" type="text" value="<?php if (isset($data['values']['lastName'])) {
  echo $data['values']['lastName'];
} ?>" maxlength="100" required />
            <?php if (isset($data['errors']['lastName'])) : ?>
              <div class="invalid-feedback"><?php $data['errors']['lastName'] ?></div>
            <?php endif; ?>
            <br />
            <label for="birthDate">Date de naissance</label>
            <input class="form-control" name="birthDate" id="birthDate" type="date" value="<?php if (isset($data['values']['birthDate'])) {
  echo $data['values']['birthDate'];
} ?>" maxlength="10" required />
            <?php if (isset($data['errors']['birthDate'])) : ?>
              <div class="invalid-feedback"><?php $data['errors']['birthDate'] ?></div>
            <?php endif; ?>
            <br />
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" type="email" value="<?php if (isset($data['values']['email'])) {
  echo $data['values']['email'];
} ?>" maxlength="255" required />
            <?php if (isset($data['errors']['email'])) : ?>
              <div class="invalid-feedback"><?php $data['errors']['email'] ?></div>
            <?php endif; ?>
            <br />
            <label for="password">Mot de passe</label>
            <input class="form-control" name="password" id="password" type="password" maxlength="255" required />
            <?php if (isset($data['errors']['password'])) : ?>
              <div class="invalid-feedback"><?php $data['errors']['password'] ?></div>
            <?php endif; ?>
            <br />
            <input class="btn btn-primary" name="registerButton" type="submit" value="S'inscrire" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
