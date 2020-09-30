<!--action :)-->
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
                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="email" maxlength="255" required/>

                    <br/>

                    <label for="password">Mot de passe</label>
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="******" maxlength="255" required/>

                    <br/>

                    <input class="btn btn-primary" type="submit" name="connection" id="connection" value="Se connecter"/>
                </div>

            </form>
            </div>
            <div class="row">
                <small>Mot de passe oubli&eacute;? | <a href="?r=registration">S'inscrire</a></small>
            </div>

        </div>
    </div>
</div>
