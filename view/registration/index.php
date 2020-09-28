<!--action :)-->

<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inscription</h3>
        </div>
        <div class="card-body">
            <form action="?r=registration/register" method="post">

                <div class="form-group col-md-10">

                    <label for="firstName">Prénom</label>
                    <input class="form-control" name="firstName" type="text" id="firstName" value="" placeholder="Prénom" maxlength="100" required/>

                    <br/>

                    <label for="lastName">Nom de famille</label>
                    <input class="form-control" name="lastName" type="text" id="lastName" value="" placeholder="Nom de famille" maxlength="100" required/>

                    <br/>

                    <label for="birthDate">Date de naissance</label>
                    <input class="form-control" type="date" name="birthDate" id="birthDate" value="" placeholder="Date de naissance" maxlength="10" required/>

                    <br/>

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="Email" maxlength="255" required/>

                    <br/>

                    <label for="password">Mot de passe</label>
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="******" maxlength="255" required/>

                    <br/>

                    <input class="btn btn-primary" type="submit" name="register" id="register" value="S'inscrire"/>
                </div>
            </form>
        </div>
    </div>
</div>