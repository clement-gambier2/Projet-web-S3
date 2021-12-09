<?php
require_once File::build_path(array("Model","ModelUtilisateur.php"));

require_once File::build_path(array("Lib","Security.php"));
require_once File::build_path(array("Lib","Session.php"));




class ControllerUtilisateur {
    protected static $object = "utilisateur";


    public static function readAll() {
        if ($_SESSION['admin'] == 1) {
            $tab_uti = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $controller = static::$object;
            $view = "list";
            $pagetitle = "Tout les utilisateurs";
            $list = File::build_path(array("View","view.php"));
            require $list;
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View", "view.php"));
            require $list;
        }
    }

    public static function read(){
        $l = ModelUtilisateur::select($_GET['idUtilisateur']);
        $controller = static::$object;
        if(!$l){
            $view = "error";
            $pagetitle = "Erreur";
            $erreur = File::build_path(array("View","view.php"));
            require $erreur;
        }
        else{
            $view = "detail";
            $pagetitle = "Detail";
            $detail = File::build_path(array("View","view.php"));
            require $detail;
        }
    }

    public static function delete(){
        $idUtilisateur = $_GET["idUtilisateur"];
        $tab_uti = ModelUtilisateur::selectAll();
        if ($_SESSION['admin'] == 1) {
            if (ModelUtilisateur::delete($idUtilisateur)) {
                $tab_uti = ModelUtilisateur::selectAll();
                $controller = self::$object;
                $view = 'deleted';
                $pagetitle = 'Utilisateur supprimé';
            }
            else {
                $controller = self::$object;
                $view = 'error';
                $pagetitle = 'Une erreur est survenue lors du delete';
            }
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }

        require_once File::build_path(array("View", "view.php"));
    }

    public static function create(){
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Créer un utilisateur";
        $action = "create";
        require File::build_path(array("View","view.php"));
    }

    public static function created(){

        //récupérer les donnés de la voiture à partir de la query string
        $data = array(
            "idUtilisateur" => $_POST["idUtilisateur"],
            "nomutilisateur" => $_POST["nom"],
            "prenomUtilisateur" => $_POST["prenom"],
            "pseudo" => $_POST["pseudo"],
            "mailUtilisateur" => $_POST["mail"],
            "motDePasseUtilisateur" => Security::hacher($_POST["motDePasse"]),
            "nonce" => Security::generateRandomHex()
        );
        $pseudo = $_POST["pseudo"];

        if ($_POST["motDePasse"] != $_POST["verifMotDePasse"]) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Erreur mot de passe';
            echo "Les mots de passes ne correspondent pas";
            require_once File::build_path(array("View", "view.php"));
        }
        else if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) == false){
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Erreur mail';
            echo "L'adresse mail n'est pas valide";
            require_once File::build_path(array("View", "view.php"));
        }
        else if (ModelUtilisateur::save($data)) {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] = 1) { //si l'utilisateur est admin on affiche le panneau, sinon non
                $tab_uti = ModelUtilisateur::selectAll();
                $controller = self::$object;
                $view = 'created';
                $pagetitle = 'Utilisateur créé';
                require_once File::build_path(array("View", "view.php"));
            }
            else {
                $pagetitle= 'Veuillez vous connecter';
                $view = 'view';
                require_once File::build_path(array("View", "view.php"));
            }


            $mail = 'Veuillez cliquer sur le lien ci-dessous pour vérifier votre compte
                    https://webinfo.iutmontp.univ-montp2.fr/~gambierc/Projet-Web-S3/index.php?controller=utilisateur&action=validate&nonce=' . $data["nonce"] . '&pseudo=' . $data["pseudo"];

            /*
            <!DOCTYPE html>
            <html lang="en" dir="ltr">
            <head>
                <meta charset="utf-8">
            </head>

            <body>
            <p>Veuillez cliquer sur le lien ci-dessous pour vérifier votre compte</p>
            <a href="https://webinfo.iutmontp.univ-montp2.fr/~gambierc/Projet-Web-S3/index.php?controller=utilisateur&action=validate&nonce=' . $data["nonce"] . '&pseudo=' . $data["pseudo"] . '"/> <br><br>
            <p>L\'équipe NFT Factory</p>

            </body>
            </html>
             */

            mail($data["mailUtilisateur"], 'Vérification de votre adresse mail', $mail);

        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue lors de la création';
            require_once File::build_path(array("View", "view.php"));
        }
    }

    public static function update(){

        if (Session::is_user($_GET['pseudo'] || $_SESSION['admin'] == 1)) {
            $controller = static::$object;
            $view = "update";
            $pagetitle = "Mettre à jour un utilisateur";
            $action = "update";
            $upd = File::build_path(array("View","view.php"));
            require $upd;
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }

    }

    public static function updated(){
        $data = array(
            "idUtilisateur" => $_POST["idUtilisateur"], //la variable n'existe pas dans le update de la view utilisateur
            "nomutilisateur" => $_POST["nom"],
            "prenomUtilisateur" => $_POST["prenom"],
            "pseudo" => $_POST["pseudo"],
            "mailUtilisateur" => $_POST["mail"],
            "motDePasseUtilisateur" => Security::hacher($_POST["motDePasse"]),
            "isAdmin" => ($_POST["isAdmin"]=='true') ? '1' : '0'
        );

        echo $_POST["idUtilisateur"] . " et " . $_POST["isAdmin"]; //debug A ENLEVER
    
        $pseudo = $_POST["pseudo"];

        if ($_POST["motDePasse"] != $_POST["verifMotDePasse"]) {
            $controller = self::$object;
            $view = 'errorMdp';
            $pagetitle = 'Erreur mot de passe';
            require_once File::build_path(array("View", "view.php"));
        }
        else if (!isset($_POST["idUtilisateur"]) || !isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["pseudo"]) || !isset($_POST["mail"]) || !isset($_POST["motDePasse"]) || !ModelUtilisateur::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue lors de l\'update';
            require_once File::build_path(array("View", "view.php"));
        }

        $tab_uti = ModelUtilisateur::selectAll();
        $controller = self::$object;
        $view = 'updated';
        $pagetitle = "Utilisateur modifié";
        require_once File::build_path(array("View", "view.php"));
    }

    public static function connect(){
        $controller = static::$object;
        $view = "connect";
        $pagetitle = "Se connecter à un compte";
        $action = "connect";
        require_once File::build_path(array("View","view.php"));
    }

    public static function connected(){
        if (!isset($_POST['pseudo']) || !isset($_POST['motDePasse'])) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Erreur de connexion';
            require_once File::build_path(array("View", "view.php"));
        }

        $pseudo = $_POST['pseudo'];
        $mdp = Security::hacher($_POST['motDePasse']);

        if(ModelUtilisateur::checkPassword($pseudo, $mdp)) {
            if (ModelUtilisateur::checkMail($pseudo)) {
                $_SESSION['login'] = $pseudo;

                if (ModelUtilisateur::isAdmin($pseudo)) {
                    $_SESSION['admin'] = 1;
                    $controller = 'admin';
                    $view = 'list';
                    $pagetitle = 'Bienvenue ' . $pseudo . ' !';
                    $action='afficher';
                    require_once File::build_path(array("View", "view.php"));
                }
                else {
                    $_SESSION['admin'] = 0;
                    $controller = 'static';
                    $view = 'home';
                    $pagetitle = 'Bienvenue ' . $pseudo . ' !';
                    require_once File::build_path(array("View", "view.php"));
                }
            } else {

                $controller = static::$object;
                $view = "connect";
                $pagetitle = "Se connecter à un compte";
                $action = "connect";
                require_once File::build_path(array("View","view.php"));
                echo "Veuillez vérifier votre adresse mail";
            }
            
            
        }
        else {
            echo "Le mot de passe ou le pseudo n'est pas bon";
            $controller = static::$object;
            $view = "connect";
            $pagetitle = "Se connecter à un compte";
            $action = "connect";
            require_once File::build_path(array("View","view.php"));
            
        }
    }

    public static function validate() {
        if (!isset($_GET['pseudo']) || !isset($_GET['nonce'])) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Erreur de vérification du mail';
            require_once File::build_path(array("View", "view.php"));
        }

        $requete = Model::getPDO()->query('SELECT nonce FROM Utilisateur WHERE pseudo="' . $_GET['pseudo'] . '"'); //gérer le cas ou le pseudo est pas bon et ou le nonce est déjà à null
        if ($requete->fetchColumn() == $_GET['nonce']) {
            $change = Model::getPDO()->prepare('UPDATE Utilisateur SET nonce=NULL WHERE pseudo="' . $_GET['pseudo'] . '"');
            $change->execute();
            $controller = self::$object;
            $view = 'marketPlace';
            $pagetitle = 'Merci d\'avoir vérifié votre mail!';
            $tab_prod = ModelProduit::selectAll();
            require_once File::build_path(array("View", "view.php"));
        } else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Erreur de vérification de l\'adresse mail';
            require_once File::build_path(array("View", "view.php"));
        }
        
    }

    public static function marketPlace() {
        $controller = static::$object;
        $view = "marketPlace";
        $pagetitle = "Market place";
        $tab_cat = ModelCategorie::selectAll();

        $tab_prod = ModelProduit::selectAll();

        require_once File::build_path(array("View","view.php"));
    }

    public static function afficherPanier() {

        if ($_SESSION['login'] != NULL) {
            $tab_prod_database = ModelProduit::selectAll();

            $tab_prod = array();

            foreach($_SESSION['panier'] as $p){
                $produit = unserialize($p);

                foreach ($tab_prod_database as $pInDataBase){

                    if($pInDataBase->get('idProduit') == $produit->get('idProduit')) {
                        array_push($tab_prod, $produit);
                    }
                }
            }

            $controller = static::$object;
            $view = "panier";
            $pagetitle = "Panier";
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }


        require_once File::build_path(array("View","view.php"));
    }



    public static function ajouterAuPanier(){
        $tab_cat = ModelCategorie::selectAll();
        if(empty($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }

        $p = ModelProduit::select($_GET['idProduit']);
        array_push($_SESSION['panier'], serialize($p));

        echo "produit ajouté au panier !";

        $controller = static::$object;
        $view = "marketPlace";
        $pagetitle = "Market place";

        $tab_prod = ModelProduit::selectAll();

        require_once File::build_path(array("View","view.php"));


    }

    public static function supprimerDuPanier(){

        $tab_prod = ModelProduit::selectAll();

        $p = ModelProduit::select($_GET['idProduit']);

        $index = array_search(serialize($p),$_SESSION['panier']);

        if(isset($index)){
            unset($_SESSION['panier'][$index]);

            $controller = static::$object;
            $view = "panier";
            $pagetitle = "Panier";

            require_once File::build_path(array("View","view.php"));
        }
        else{
            $view = "error";
            $pagetitle = "Erreur";
            $erreur = File::build_path(array("View","view.php"));
            require $erreur;
        }




    }



    public static function deconnect() {
        session_unset();
        $controller = self::$object;
        $view = 'marketPlace';
        $pagetitle = 'Déconnexion réussie';
        $tab_prod = ModelProduit::selectAll();
        require_once File::build_path(array("View", "view.php"));
    }
}




?>
