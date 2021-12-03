<?php
require_once File::build_path(array("Model","ModelUtilisateur.php"));

require_once File::build_path(array("Lib","Security.php"));
require_once File::build_path(array("Lib","Session.php"));




class ControllerUtilisateur {
    protected static $object = "utilisateur";


    public static function readAll() {
        $tab_uti = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        $controller = static::$object;
        $view = "list";
        $pagetitle = "Tout les utilisateurs";
        $list = File::build_path(array("View","view.php"));
        require $list;
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
        if (ModelUtilisateur::delete($idUtilisateur)) {
            $tab_uti = ModelUtilisateur::selectAll();
            $controller = self::$object;
            $view = 'deleted';
            $pagetitle = 'Utilisateur supprimé';
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
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
            "idUtilisateur" => $_POST["user_id"],
            "nomutilisateur" => $_POST["nom"],
            "prenomUtilisateur" => $_POST["prenom"],
            "pseudo" => $_POST["pseudo"],
            "mailUtilisateur" => $_POST["mail"],
            "motDePasseUtilisateur" => Security::hacher($_POST["motDePasse"])
        );
        $pseudo = $_POST["pseudo"];

        if ($_POST["motDePasse"] != $_POST["verifMotDePasse"]) {
            $controller = self::$object;
            $view = 'errorMdp';
            $pagetitle = 'Erreur mot de passe';
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
                require_once File::build_path(array("View", "view.php"));
            }
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
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
            echo "Veuillez vous connecter :";
            $controller = self::$object;
            $view = 'connect';
            $pagetitle = 'Page de connexion';
            require_once File::build_path(array("View", "utilisateur", "connect.php"));
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
            "isAdmin" => $_POST["isAdmin"]
        );

        echo $_POST["idUtilisateur"] . " et " . $_POST["isAdmin"];
    
        $pseudo = $_POST["pseudo"];

        if ($_POST["motDePasse"] != $_POST["verifMotDePasse"]) {
            $controller = self::$object;
            $view = 'errorMdp';
            $pagetitle = 'Erreur mot de passe';
            require_once File::build_path(array("View", "view.php"));
        }
        else if (!isset($_POST["user_id"]) || !isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["pseudo"]) || !isset($_POST["mail"]) || !isset($_POST["motDePasse"]) || !ModelUtilisateur::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
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
            if (!isset($_GET['pseudo']) || !isset($_GET['motDePasse'])) {
                $controller = self::$object;
                $view = 'error';
                $pagetitle = 'Erreur de connexion';
                require_once File::build_path(array("View", "view.php"));
            }

            $pseudo = $_GET['pseudo'];
            $mdp = Security::hacher($_GET['motDePasse']);

            if(ModelUtilisateur::checkPassword($pseudo, $mdp)) {
                $_SESSION['login'] = $pseudo;

                if (ModelUtilisateur::isAdmin($pseudo)) {
                    $_SESSION['admin'] = 1;
                    $controller = 'Admin';
                    $view = 'list';
                    $pagetitle = 'Bienvenue ' . $pseudo . ' !';
                    $action='afficher';
                    require_once File::build_path(array("View", "view.php"));
                }
                else {
                    $_SESSION['admin'] = 0;
                    $controller = self::$object;
                    $view = 'marketPlace';
                    $pagetitle = 'Bienvenue ' . $pseudo . ' !';
                    $tab_prod = ModelProduit::selectAll();
                    require_once File::build_path(array("View", "view.php"));
                }
            }
            else {
                $controller = self::$object;
                $view = 'error';
                $pagetitle = 'Mauvais mot de passe';
                require_once File::build_path(array("View", "view.php"));
            }
    }

    public static function marketPlace() {
        $controller = static::$object;
        $view = "marketPlace";
        $pagetitle = "Market place";

        $tab_prod = ModelProduit::selectAll();

        require_once File::build_path(array("View","view.php"));
    }

    public static function afficherPanier() {
        $controller = static::$object;
        $view = "panier";
        $pagetitle = "Panier";

        require_once File::build_path(array("View","view.php"));
    }



    public static function ajouterAuPanier(){
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

    public static function deconnect() {
        session_unset();
        $controller = self::$object;
        $view = 'detail';
        $pagetitle = 'Déconnexion réussie';
        require_once File::build_path(array("View", "view.php"));
    }
}




?>
