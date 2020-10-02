<!--action :)-->

<?php
if (isset($_SESSION['registerData'])) {
  if (isset($_SESSION['registerData']['errors'])) {
    $errors = $_SESSION['registerData']['errors'];
    foreach ($errors as $err) {
      echo $err;
      echo '<br>';
    }
    $firstName = $_SESSION['registerData']['firstName'];
    $lastName = $_SESSION['registerData']['lastName'];
    $birthDate = $_SESSION['registerData']['birthDate'];
    $email = $_SESSION['registerData']['email'];
  }
  unset($_SESSION['registerData']);
}
?>
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
            <input class="form-control" name="firstName" type="text" id="firstName" value="<?php if (isset($firstName)) {
                                                                                              echo $firstName;
                                                                                            }
                                                                                            echo (''); ?>" placeholder="" maxlength="100" required />

            <br />
            <label for="lastName">Nom</label>
            <input class="form-control" name="lastName" id="lastName" type="text" value="<?php if (isset($lastName)) {
                                                                                            echo $lastName;
                                                                                          }
                                                                                          echo (''); ?>" placeholder="" maxlength="100" required />
            <br />
            <label for="birthDate">Date de naissance</label>
            <input class="form-control" name="birthDate" id="birthDate" type="date" value="<?php if (isset($birthDate)) {
                                                                                              echo $birthDate;
                                                                                            }
                                                                                            echo (''); ?>" placeholder="" maxlength="10" required />
            <br />
            <label for="email">Email</label>
            <input class="form-control" name="email" id="email" type="email" value="<?php if (isset($email)) {
                                                                                      echo $email;
                                                                                    }
                                                                                    echo (''); ?>" placeholder="" maxlength="255" required />
            <br />
            <label for="password">Mot de passe</label>
            <input class="form-control" name="password" id="password" type="password" value="" placeholder="" maxlength="255" required />
            <br />
            <input class="btn btn-primary" name="registerButton" type="submit" value="S'inscrire" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>