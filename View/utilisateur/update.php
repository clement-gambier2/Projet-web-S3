<?php
    $idUtilisateur = "";
    if(isset($_GET["idUtilisateur"])) $idUtilisateur = $_GET["idUtilisateur"];

    $nom = "";
    $prenom = "";
    $pseudo = "";
    $prenomUtilisateur = "";
    $nomutilisateur = "";
    $mailUtilisateur = "";
    $isAdmin = 0;

    if($idUtilisateur != ""){
        require_once File::build_path(Array("Model", "ModelUtilisateur.php"));
        $utilisateur = ModelUtilisateur::select($idUtilisateur);

        $nom = htmlspecialchars($utilisateur->get('nomutilisateur'));
        $prenom = htmlspecialchars($utilisateur->get('prenomUtilisateur'));
        $pseudo = htmlspecialchars($utilisateur->get('pseudo'));
        $mailUtilisateur = htmlspecialchars($utilisateur->get('mailUtilisateur'));
        $isAdmin = htmlspecialchars($utilisateur->get('isAdmin'));
    }
?>





<link rel="stylesheet" href="css/form.css">
<form method="post" class="glass2" action="index.php?action=<?php echo ($action == "create") ? 'created' : 'updated' ?>&controller=<?php echo static::$object ?>">

    <fieldset>
            <h2>Création ou mise à jour de l'utilisateur</h2>

        <input type="hidden" name='action' value='<?php echo ($action == "create") ? 'created' : 'updated' ?>'>
        <input type="hidden" name='controller' value='utilisateur'>


        <p>
            <label for="nom">Nom</label>
            <input type="text" placeholder="Nom de l'utilisateur" name="nom" id="nom" value="<?php echo $nom; ?>" required/>
        </p>

        <p>
            <label for="prenom">Prenom</label>
            <input type="text" placeholder="Prénom de l'utilisateur" name="prenom" id="prenom" value="<?php echo $prenom; ?>" required/>
        </p>

        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" placeholder="Pseudo de l'utilisateur" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" required/>
        </p>

        <p>
            <label for="mail">Mail</label>
            <input type="text" placeholder="mail.utilisateur@gmail.com" name="mail" id="mail" value="<?php echo $mailUtilisateur; ?>" required/>
        </p>

        <p>
            <label for="motDePasse">Mot de passe</label> :
            <input type="password" placeholder="Mot de passe" name="motDePasse" id="motDePasse" required/>
        </p>

        <p>
            <label for="verifMotDePasse">Valider mot de passe</label> :
            <input type="password" placeholder="Vérification du mot de passe" name="verifMotDePasse" id="verifMotDePasse" required/>
        </p>

        <?php
            if ($_SESSION['admin'] == 1) {
                echo '<p>';
                    echo '<label for="admin">Administrateur</label>';
                    if ($isAdmin == 1) { 
                        $checkAdmin = 'checked';
                    } else {
                        $checkAdmin = '';
                    }
                    echo '<input type="checkbox" name="isAdmin" id="admin" ' . $checkAdmin .' required/>';
                echo '</p>';
            } else {
                //faire un echo d'un champ hidden avec une valeur false pour 'isAdmin'
            }
        ?>

        <div id="send">
            <p>
                <input type="submit" value="Envoyer" id="submit" />
            </p>
        </div>


    </fieldset>
</form>