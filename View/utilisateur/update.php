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

        $nom = htmlspecialchars($utilisateur->getNom());
        $prenom = htmlspecialchars($utilisateur->getPrenom());
        $pseudo = htmlspecialchars($utilisateur->getPseudo());
        $mailUtilisateur = htmlspecialchars($utilisateur->getMail());
        $motDePasseUtilisateur = htmlspecialchars($utilisateur->getMotDePasseUtilisateur());
    }
?>


<form method="post" action="/p_web_s3/index.php?action=<?php echo ($action == "create") ? 'created' : 'updated' ?>&controller=<?php echo static::$object ?>">
    <fieldset>
        <legend>Création ou mise à jour de l'utilisateur</legend>

        <p>
            <label for="user_id">IdUtilisateur</label> :
            <input type="text" placeholder="clementg" name="user_id" id="user_id" value="<?php echo htmlspecialchars($idUtilisateur); ?>" <?php if($action == 'update') echo "readonly"; ?>/>
        </p>

        <p>
            <label for="immat_id">Nom</label> :
            <input type="text" placeholder="gambier" name="nom" id="marque_id" value="<?php echo $nom; ?>" required/>
        </p>

        <p>
            <label for="prenom">Prenom</label> :
            <input type="text" placeholder="clément" name="prenom" id="prenom" value="<?php echo $prenom; ?>" required/>
        </p>

        <p>
            <label for="pseudo">Pseudo</label> :
            <input type="text" placeholder="clem" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" required/>
        </p>

        <p>
            <label for="mail">Mail</label> :
            <input type="text" placeholder="clement.gambier@gmail.com" name="mail" id="mail" value="<?php echo $mailUtilisateur; ?>" required/>
        </p>

        <p>
            <label for="motDePasse">Mot de passe</label> :
            <input type="text" placeholder="mot de passe sécurisé" name="motDePasse" id="motDePasse" value="<?php echo $motDePasseUtilisateur; ?>" required/>
        </p>


        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>