<?php
require_once File::build_path(Array("Model", "ModelCategorie.php"));

class ControllerCategorie {

    protected static $object = 'categorie';

    public static function readAll() {
        if ($_SESSION['admin'] == 1) {
            $tab_cat = ModelCategorie::selectAll();     //appel au modèle pour gerer la BD

            $controller = static::$object;
            $view = 'list';
            $pagetitle = 'Liste des produits';

            $list = File::build_path(array("View", "view.php"));
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
            $p = ModelProduit::select($_GET['idProduit']); //on récupère le produit
            $controller = static::$object;
    
            if ($p == null) { //si il est null on retourne une erreur
    
                $view = "error";
                $pagetitle = "Erreur Produit";
                $erreur = File::build_path(array("View", "view.php"));
                require $erreur;
    
            } else { //sinon on va afficher l'article
    
                $view = 'detail';
                $pagetitle = 'Détail de l\'article';
                $detail = File::build_path(array("View", "view.php"));
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

    public static function create(){
        if ($_SESSION['admin'] == 1) {
            $controller='categorie';
            $tab_categorie = ModelCategorie::selectAll();
            $view='update';
            $action = "created";
            $pagetitle='Création d\'une categorie';
    
            require_once File::build_path(array("View", "view.php"));
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }
        
    }

    public static function created(){

        //récupérer les donnés de la voiture à partir de la query string
        $data = array(
            "nomCategorie" => $_POST["nomCategorie"],

        );
        if (ModelCategorie::save($data)) {
            $tab_cat = ModelCategorie::selectAll();
            $controller = self::$object;
            $view = 'created';
            $pagetitle = 'Produit créé';
            require_once File::build_path(array("View", "view.php"));
        }
        else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("View", "view.php"));
        }
    }


    public static function delete() {
        if ($_SESSION['admin'] == 1) {
            $idC= $_GET['idCategorie'];
            $c = ModelCategorie::select($idC);
    
            if($c -> delete($idC)){
                $tab_cat = ModelCategorie::selectAll();
    
                $controller = self::$object;
                $view='deleted';
                $pagetitle='Supprimer une categorie';
                require_once File::build_path(array("View", "view.php"));
            }
            else{
                $tab_cat = ModelCategorie::selectAll();
    
                echo "Impossible de supprimer cette catégorie elle contient des produits !!!";
                $controller = self::$object;
                $view = 'list';
                $pagetitle = 'Une erreur est survenue en updatant la catégorie';
    
                require_once File::build_path(array("View", "view.php"));
            }
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }
        
    }

    public static function update(){
        if ($_SESSION['admin'] == 1) {
            $controller = static::$object;
            $idCategorie = $_GET['idCategorie'];
            $tab_categorie = ModelCategorie::selectAll();
            $action = "updated";
    
            $view = "update";
            $pagetitle = "Mise à jour d'un produit";
            require_once File::build_path(array("View","view.php"));
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder à cette fonctionnalité admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }
        
    }

    public static function updated(){

        $nomCategorie = $_POST['nomCategorie'];

        $data = array(
            "idCategorie" => $_POST['idCategorie'],
            "nomCategorie" => $_POST['nomCategorie'],

        );


        if (!isset($_POST["nomCategorie"]) || !ModelCategorie::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue en updatant la catégorie';
            require_once File::build_path(array("View", "view.php"));
        }

        $tab_cat = ModelCategorie::selectAll();
        $controller = self::$object;
        $view = 'updated';
        $pagetitle = "Le produit à été modifié";
        require_once File::build_path(array("View", "view.php"));
    }
}
?>