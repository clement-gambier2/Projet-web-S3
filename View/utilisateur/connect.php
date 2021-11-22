<form>
    <fieldset>
        <legend>Connexion</legend>

        <input type="hidden" name='action' value='connected'>
        <input type="hidden" name='controller' value='utilisateur'>

        <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" placeholder="Pseudo" name="pseudo" id="pseudo" required/>
        </p>

        <p>
            <label for="motDePasse">Mot de passe :</label>
            <input type="text" placeholder="Mot de passe" name="motDePasse" id="motDePasse"  required/>
        </p>


        <p>
            <input type="submit" value="Se connecter" />
        </p>
    </fieldset>
</form>
</form>