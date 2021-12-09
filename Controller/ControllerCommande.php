<?php
require_once File::build_path(array("Model","ModelCommande.php"));
require_once File::build_path(array("Model","ModelProduit.php"));
require_once File::build_path(array("Model","ModelUtilisateur.php"));

class ControllerCommande {
    protected static $object = "commande";

    public static function afficherCommandeUser(){

        if(isset($_SESSION['login'])){
            $user = ModelUtilisateur::selectWithPseudo($_SESSION['login']);
            $userId = $user->get('idUtilisateur');

            $tab_com = ModelCommande::getAllCommandes($userId);

            $controller = static::$object;
            $view = "commandeUser";
            $pagetitle = "Mes commandes";
            $list = File::build_path(array("View","view.php"));
            require $list;

        }
        else{
            echo "Connectez vous";
        }

    }

    public static function readAll() {
        if ($_SESSION['admin'] == 1) {
            $tab_com = ModelCommande::selectAll();     //appel au modèle pour gerer la BD
            $controller = static::$object;
            $view = "list";
            $pagetitle = "Commandes des users";
            $list = File::build_path(array("View","view.php"));
            require $list;
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }
        
    }



    public static function read(){

        if ($_SESSION['admin'] == 1) {
            $idC = $_GET['idCommande'];
            if(isset($_GET['idUtilisateur'])){
                $idU = $_GET['idUtilisateur'];
            }

            $l = ModelProduit::getAllProduits($idC);
            if(!$l){
                $controller = static::$object;
                $view = "error";
                $pagetitle = "Erreur";
                $erreur = File::build_path(array("View","view.php"));
                require $erreur;
            }
            else{
                $type = $_GET['type'];
                $controller = static::$object;
                $view = "detail";
                $pagetitle = "Detail";
                $detail = File::build_path(array("View","view.php"));
                require $detail;
            }
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }

    }

    public static function delete(){
        $idCommande = $_GET["idCommande"];
        $tab_com = ModelProduit::selectAll();

        if ($_SESSION['admin'] == 1 && ModelCommande::delete($idCommande)) {
            if(isset($_GET['mesCommande'])){
                $user = ModelUtilisateur::selectWithPseudo($_SESSION['login']);
                $userId = $user->get('idUtilisateur');

                $tab_com = ModelCommande::getAllCommandes($userId);

                $action = "mesCommandes";
                $controller = self::$object;
                $view = 'deleted';
                $pagetitle = 'Commande supprimé';
                require_once File::build_path(array("View", "view.php"));
            }
            else{
                $tab_com = ModelCommande::selectAll();

                $action = "autre";

                $controller = self::$object;
                $view = 'deleted';
                $pagetitle = 'Commande supprimé';
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

    public static function create(){
        if ($_SESSION['admin'] == 1) {
            $tab_prod = ModelProduit::selectAll();
            $tab_utilisateur = ModelUtilisateur::selectAll();
            $controller = static::$object;
            $view = "update";
            $pagetitle = "Créer une commande";
            $action = "created";
        require File::build_path(array("View","view.php"));
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }
        
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

    public static function createCommandePanier(){


        if(isset($_SESSION['panier']) && isset($_SESSION['login'])){

            $data = array();
            $produits = $_SESSION['panier'];
            $user = ModelUtilisateur::selectWithPseudo($_SESSION['login']);
            $idUtilisateur = $user->get('idUtilisateur');
            $tab_prod_all = ModelProduit::selectAll();

            ModelCommande::saveCommande($idUtilisateur, $data);

            foreach($produits as $p){
                $produit = unserialize($p);
                foreach ($tab_prod_all as $prodInDatabase){
                    $prodId = $produit->get('idProduit');

                    if($prodInDatabase->get('idProduit') == $prodId){
                        ModelCommande::saveProduitsCommande($idUtilisateur, $prodId);
                    }
                }
            }
            $_SESSION['panier'] = array();

            echo "Commande passé";
            $controller = 'Utilisateur';
            $view = 'panier';
            $pagetitle = 'Panier';
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
        if ($_SESSION['admin'] == 1) {
            $tab_prod = ModelProduit::selectAll();

            $controller = static::$object;
            $idCommande = $_GET['idCommande'];
            $idUtilisateur = $_GET['idUtilisateur'];

            $tab_produitChecked = ModelProduit::getAllProduits($idCommande);
            $view = "update";
            $pagetitle = "Mettre à jour une commande";
            $action = "updated";
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

        if (!isset($_GET['idCommande']) | !isset($_GET['idUser']) |!isset($_GET['idCommande'])) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("View", "view.php"));
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
