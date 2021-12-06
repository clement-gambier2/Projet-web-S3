<link rel="stylesheet" href="css/form.css">
<form class="glass2" method="post" action="index.php?controller=utilisateur&action=connected">
    <fieldset>
        <h2>Connexion</h2>

        <input type="hidden" name='action' value='connected'>
        <input type="hidden" name='controller' value='utilisateur'>

        <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" placeholder="Pseudo" name="pseudo" id="pseudo" required/>
        </p>

        <p>
            <label for="motDePasse">Mot de passe :</label>
            <input type="password" placeholder="Mot de passe" name="motDePasse" id="motDePasse"  required/>
        </p>


        <p>
            <input type="submit" value="Se connecter" id="submit"/>
        </p>

        <p>
            <a href="index.php?action=create&controller=Utilisateur" id="submit">Créer un compte</a>
        </p>
    </fieldset>
</form>
</form>