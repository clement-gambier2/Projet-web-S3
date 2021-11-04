<?php
require_once File::build_path(array("Model","ModelCommande.php"));

class ControllerCommande {
    protected static $object = "commande";


    public static function readAll() {
        $tab_com = ModelCommande::selectAll();     //appel au modèle pour gerer la BD
        $controller = static::$object;
        $view = "list";
        $pagetitle = "Commandes des users";
        $list = File::build_path(array("View","view.php"));
        require $list;
    }

    public static function read(){
        $idC = $_GET['idCommande'];
        $l = ModelCommande::getAllProduits($idC);
        if(!$l){
            $controller = static::$object;
            $view = "error";
            $pagetitle = "Erreur";
            $erreur = File::build_path(array("view","view.php"));
            require $erreur;
        }
        else{
            $controller = static::$object;
            $view = "detail";
            $pagetitle = "Detail";
            $detail = File::build_path(array("view","view.php"));
            require $detail;
        }
    }

    public static function delete(){
        $login = $_GET["login"];
        $tab_uti = ModelUtilisateur::selectAll();
        if (ModelUtilisateur::delete($login)) {
            $tab_v = ModelUtilisateur::selectAll();

            $controller = self::$object;
            $view = 'deleted';
            $pagetitle = 'Utilisateur supprimé';
            require_once File::build_path(array("view", "view.php"));
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("view", "view.php"));
        }
    }

    public static function create(){
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Créer un utilisateur";
        $action = "create";
        require File::build_path(array("view","view.php"));
    }

    public static function created(){

        //récupérer les donnés de la voiture à partir de la query string
        $data = array(
            "login" => $_POST["login"],
            "nom" => $_POST["nom"],
            "prenom" => $_POST["prenom"],
        );

        if (ModelUtilisateur::save($data)) {
            $tab_uti = ModelUtilisateur::selectAll();
            $controller = self::$object;
            $view = 'created';
            $pagetitle = 'Utilisateur créé';
            require_once File::build_path(array("view", "view.php"));
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("view", "view.php"));
        }
    }

    public static function update(){
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Mettre à jour un utilisateur";
        $action = "update";
        $upd = File::build_path(array("view","view.php"));
        require $upd;
    }

    public static function updated(){
        $data = array(
            "login" => $_POST["login"],
            "nom" => $_POST["nom"],
            "prenom" => $_POST["prenom"]
        );
        $login = $_POST["login"];

        if (!isset($_POST["nom"]) || !isset($_POST["prenom"]) || !ModelUtilisateur::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("view", "view.php"));
        }

        $tab_uti = ModelUtilisateur::selectAll();
        $controller = self::$object;
        $view = 'updated';
        $pagetitle = "Utilisateur modifié";
        require_once File::build_path(array("view", "view.php"));
    }

}




?>
