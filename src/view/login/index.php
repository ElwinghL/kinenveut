<!--action :)-->

<?php
    if (isset($_SESSION['loginData'])) {
      if (isset($_SESSION['loginData']['errors'])) {
        $errors = $_SESSION['loginData']['errors'];
        foreach ($errors as $err) {
          echo $err;
          echo '<br>';
        }
      }
      unset($_SESSION['loginData']);
    }
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Connexion</h3>
        </div>
        <div class="card-body">

            <div class="row">
            <form action="?r=login/login" method="post">

                <div class="form-group col-md-10">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="" maxlength="255" required/>

                    <br/>

                    <label for="password">Mot de passe</label>
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="" maxlength="255" required/>

                    <br/>

                    <input class="btn btn-primary" type="submit" name="connection" value="Se connecter"/>
                </div>

            </form>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <small><a href="?r=registration">S'inscrire</a></small>
                </div>
            </div>

        </div>
    </div>
</div>
