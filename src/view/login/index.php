<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-2">
    <img class="big-logo" src="resources/logo.png" width="237" height="215" alt="" />
  </div>
  <div class="col-md-5"></div>
</div>

<br/>

<div class="modal-dialog modal-dialog-centered" tabindex="-1">
    <div class="modal-content">
        <div class="card">
            <div class="card-header" style="text-align: center">
                <h3 class="card-title">Connexion</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <form id="login_form" action="?r=login/login" method="post" class="<?php if (!empty($data['errors'])) {
                        echo 'was-validated';
                    } ?>" style="margin: 0 auto;">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="255" required />

                            <label for="password">Mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password" maxlength="255" required />

                            <br />
                            <?php if (isset($data['errors']['wrongIdentifiers'])) : ?>
                                <div class="invalid-feedback d-block"><?php echo $data['errors']['wrongIdentifiers'] ?></div>
                            <?php endif; ?>

                            <div style="text-align: center">
                                <input class="btn btn-primary" type="submit" name="connection" value="Se connecter" />
                            </div>

                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <small><a href="?r=registration">S'inscrire</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

