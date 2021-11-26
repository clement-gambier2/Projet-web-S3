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
        $idU = $_GET['idUtilisateur'];

        $l = ModelProduit::getAllProduits($idC);
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
        $idCommande = $_GET["idCommande"];
        $tab_com = ModelProduit::selectAll();
        if (ModelCommande::delete($idCommande)) {
            $tab_com = ModelCommande::selectAll();

            $controller = self::$object;
            $view = 'deleted';
            $pagetitle = 'Commande supprimé';
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
        $tab_prod = ModelProduit::selectAll();
        $tab_utilisateur = ModelUtilisateur::selectAll();
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Créer une commande";
        $action = "created";
        require File::build_path(array("view","view.php"));
    }

    public static function created(){

        $data = array();
        $produits = $_GET['produit'];
        $idUtilisateur = $_GET['idUser'];


        if(isset($produits)){
            ModelCommande::saveCommande($idUtilisateur, $data);

            foreach($produits as $p){
                ModelCommande::saveProduitsCommande($idUtilisateur, $p);
            }
            $tab_com = ModelCommande::selectAll();
            $controller = self::$object;
            $view = 'created';
            $pagetitle = 'Nouvelle commande enregistrée';
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
        $tab_prod = ModelProduit::selectAll();

        $controller = static::$object;
        $idCommande = $_GET['idCommande'];
        $idUtilisateur = $_GET['idUtilisateur'];

        $tab_produitChecked = ModelProduit::getAllProduits($idCommande);
        $view = "update";
        $pagetitle = "Mettre à jour une commande";
        $action = "updated";
        $upd = File::build_path(array("view","view.php"));
        require $upd;
    }

    public static function updated(){





        if (!isset($_GET['idCommande']) | !isset($_GET['idUser']) |!isset($_GET['idCommande'])) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("view", "view.php"));
        }
        else{
            $idCommande = $_GET['idCommande'];
            $produits = $_GET['produit'];
            $idUtilisateur = $_GET['idUser'];

            ModelCommande::updateCommande($idCommande, $produits, $idUtilisateur);

            $tab_com = ModelCommande::selectAll();     //appel au modèle pour gerer la BD
            static::readAll();
        }


    }

}




?>
