<?php
    $idUtilisateur = "";
    if(isset($_GET["idUtilisateur"])) $idUtilisateur = $_GET["idUtilisateur"];

    $nom = "";
    $prenom = "";
    $pseudo = "";
    $prenomUtilisateur = "";
    $nomutilisateur = "";
    $motDePasseUtilisateur = "";
    $mailUtilisateur = "";

    if($idUtilisateur != ""){
        require_once File::build_path(Array("Model", "ModelUtilisateur.php"));
        $utilisateur = ModelUtilisateur::select($idUtilisateur);

        $nom = htmlspecialchars($utilisateur->get('nomUtilisateur'));
        $prenom = htmlspecialchars($utilisateur->get('prenomUtilisateur'));
        $pseudo = htmlspecialchars($utilisateur->get('pseudoUtilisateur'));
        $mailUtilisateur = htmlspecialchars($utilisateur->get('mailUtilisateur'));
        $motDePasseUtilisateur = htmlspecialchars($utilisateur->get('motDePasseUtilisateur'));
    }
?>





<link rel="stylesheet" href="css/form.css">
<form method="post" class="glass2" action="index.php?action=<?php echo ($action == "create") ? 'created' : 'updated' ?>&controller=<?php echo static::$object ?>">

    <fieldset>
        <h2>Création ou mise à jour de l'utilisateur</h2>

        <input type="hidden" name='action' value='<?php echo ($action == "create") ? 'created' : 'updated' ?>'>
        <input type="hidden" name='controller' value='utilisateur'>


        <p>
            <label for="immat_id">Nom</label>
            <input type="text" placeholder="gambier" name="nom" id="marque_id" value="<?php echo $nom; ?>" required/>
        </p>

        <p>
            <label for="prenom">Prenom</label>
            <input type="text" placeholder="clément" name="prenom" id="prenom" value="<?php echo $prenom; ?>" required/>
        </p>

        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" placeholder="clem" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" required/>
        </p>

        <p>
            <label for="mail">Mail</label>
            <input type="text" placeholder="clement.gambier@gmail.com" name="mail" id="mail" value="<?php echo $mailUtilisateur; ?>" required/>
        </p>

        <p>
            <label for="motDePasse">Mot de passe</label> :
            <input type="password" placeholder="mot de passe sécurisé" name="motDePasse" id="motDePasse" value="<?php echo $motDePasseUtilisateur; ?>" required/>
        </p>

        <p>
            <label for="motDePasse">Valider mot de passe</label> :
            <input type="password" placeholder="mot de passe sécurisé" name="verifMotDePasse" id="verifMotDePasse" value="<?php echo $motDePasseUtilisateur; ?>" required/>

        </p>

        <div id="send">
            <p>
                <input type="submit" value="Envoyer" id="submit" />
            </p>
        </div>


    </fieldset>
</form>