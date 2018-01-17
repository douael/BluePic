<section id="content">
    <div class="content">
        <h1 style="text-align: center">Configuration</h1>
        <br>
        <br>
        <form class="form-group" action="/Install/saveConfig" method="post">

                <fieldset>
                    <legend>Administrateur</legend>
                    <div class="form-row">
                        <label for="pseudo">Votre pseudo :</label>
                        <input id="pseudo" type="text" name="username" placeholder="Votre pseudo" required="">
                    </div>
                    <div class="form-row">
                        <label for="firstname">Votre prenom :</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Votre prenom" required="">
                    </div>
                    <div class="form-row">
                        <label for="lastname">Votre nom :</label>
                        <input id="lastname" type="text" name="lastname" placeholder="Votre nom" required="">
                    </div>
                    <div class="form-row">
                        <label for="email">Votre email :</label>
                        <input id="email" type="email" name="email" placeholder="Votre email" required="">
                    </div>
                    <div class="form-row">
                        <label for="pwd">Votre mot de passe :</label>
                        <input id="pwd" type="password" name="pwd" placeholder="Votre mot de passe" required="">
                    </div>
                </fieldset>

            <br>



            <div class="form-row">
                <input type="submit" value="Valider" />
            </div>
        </form>
    </div>
</section>
