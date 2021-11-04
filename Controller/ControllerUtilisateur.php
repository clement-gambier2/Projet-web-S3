<?php
require_once File::build_path(array("Model","ModelUtilisateur.php"));
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
            "motDePasseUtilisateur" => $_POST["motDePasse"]
        );
        $pseudo = $_POST["pseudo"];

        if (ModelUtilisateur::save($data)) {
            $tab_uti = ModelUtilisateur::selectAll();
            $controller = self::$object;
            $view = 'created';
            $pagetitle = 'Utilisateur créé';
            require_once File::build_path(array("View", "view.php"));
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("View", "view.php"));
        }
    }

    public static function update(){
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Mettre à jour un utilisateur";
        $action = "update";
        $upd = File::build_path(array("View","view.php"));
        require $upd;
    }

    public static function updated(){
        $data = array(
            "idUtilisateur" => $_POST["user_id"],
            "nomutilisateur" => $_POST["nom"],
            "prenomUtilisateur" => $_POST["prenom"],
            "pseudo" => $_POST["pseudo"],
            "mailUtilisateur" => $_POST["mail"],
            "motDePasseUtilisateur" => $_POST["motDePasse"]
        );
        $pseudo = $_POST["pseudo"];

        if (!isset($_POST["user_id"]) || !isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["pseudo"]) || !isset($_POST["mail"]) || !isset($_POST["motDePasse"]) || !ModelUtilisateur::update($data)) {
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

}




?>
