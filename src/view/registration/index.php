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
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inscription</h3>
        </div>
        <div class="card-body">
            <form action="?r=registration/register" method="post">

                <div class="form-group col-md-10">

                    <label for="firstName">Prénom</label>
                    <input class="form-control" name="firstName" type="text" id="firstName" value="<?php if (isset($firstName)) {
  echo $firstName;
} echo(''); ?>" placeholder="" maxlength="100" required/>

                    <br/>

                    <label for="lastName">Nom</label>
                    <input class="form-control" name="lastName" type="text" value="<?php if (isset($lastName)) {
  echo $lastName;
} echo(''); ?>" placeholder="" maxlength="100" required/>

                    <br/>

                    <label for="birthDate">Date de naissance</label>
                    <input class="form-control" name="birthDate" type="date" value="<?php if (isset($birthDate)) {
  echo $birthDate;
} echo(''); ?>" placeholder="" maxlength="10" required/>

                    <br/>

                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="email" value="<?php if (isset($email)) {
  echo $email;
} echo(''); ?>" placeholder="" maxlength="255" required/>

                    <br/>

                    <label for="password">Mot de passe</label>
                    <input class="form-control" name="password" type="password" value="" placeholder="" maxlength="255" required/>

                    <br/>

                    <input class="btn btn-primary" name="registerButton" type="submit"  value="S'inscrire"/>
                </div>
            </form>
        </div>
    </div>
</div>