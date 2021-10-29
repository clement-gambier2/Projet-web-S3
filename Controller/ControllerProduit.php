<?php
require_once File::build_path(Array("Model", "ModelProduit.php"));

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $tab_v = ModelProduit::selectAll();     //appel au modèle pour gerer la BD
        
        $controller = self::$object;
        $view = 'list';
        $pagetitle = 'Liste des produits';

        require_once File::build_path(Array("view", "view.php"));

    }

    public static function read(){

        $p = ModelProduit::select($_GET['idProduit']); //on récupère le produit

        if ($p == null) { //si il est null on retourne une erreur
            require_once File::build_path(Array("view", "produit", "error.php"));
        } else { //sinon on va afficherl'article
            $controller='produit';
            $view = 'detail';
            $pagetitle = 'Détail de l\'article';
            require_once File::build_path(Array("view", "view.php"));
        }
    }

    public static function create(){
        $controller='produit';
        $view='create';
        $pagetitle='Création d\'un produit';
    }

    public static function created(){
        $idP = $_GET['idProduit'];
        $n = $_GET['nom'];
        $idC = $_GET['idCategorie'];
        $d = $_GET['description'];
        $p = $_GET['produit'];

        $p = new ModelProduit($idP, $n, $idC, $d, $p);
        $p->save();

        $tab_p = ModelProduit::selectAll();

        $controller='voiture';
        $view='created';
        $pagetitle='Liste des produits';
        require_once File::build_path(Array("view", "view.php"));
    }

    public static function delete() {
        $idP = $_GET['idProduit'];

        $p = ModelProduit::select($idP);
        $p -> delete($idP);

        $tab_p = ModelProduit::selectAll();

        $controller='voiture';
        $view='deleted';
        $pagetitle='Supprimer une voiture';
        require_once File::build_path(Array("view", "voiture", "deleted.php"));
    }

}
?>