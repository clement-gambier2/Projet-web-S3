<?php
require_once File::build_path(Array("Model", "ModelProduit.php"));

class ControllerProduit {

    protected static $object = 'produit';

    public static function readAll() {
        $tab_p = ModelProduit::selectAll();     //appel au modèle pour gerer la BD

        $controller = static::$object;
        $view = 'list';
        $pagetitle = 'Liste des produits';

        $list = File::build_path(array("View", "view.php"));
        require $list;
    }

    public static function read(){

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
    }

    public static function create(){
        $controller='produit';
        $view='create';
        $pagetitle='Création d\'un produit';
        require_once File::build_path(array("View", "view.php"));
    }

    public static function created(){
        $idP = $_GET['idProduit']; // faire en sorte qu'il s'autoincrémente plutot que de le remplir à la main
        $n = $_GET['nomProduit'];
        $d = $_GET['descriptionProduit'];
        $idC = $_GET['idCategorie'];
        $p = $_GET['prixProduit'];
        $q = $_GET['quantiteProduit'];

        $p = new ModelProduit($idP, $n, $d, $idC, $p, $d);
        $p->save();

        $tab_p = ModelProduit::selectAll();

        $controller='produit';
        $view='created';
        $pagetitle='Liste des produits';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        $idP = $_GET['idProduit'];

        $p = ModelProduit::select($idP);
        $p -> delete($idP);

        $tab_p = ModelProduit::selectAll();

        $controller='produit';
        $view='deleted';
        $pagetitle='Supprimer un produit';
        require_once File::build_path(array("view", "produit", "deleted.php"));
    }

    public static function update(){
        $controller = static::$object;
        $view = "update";
        $pagetitle = "Mise à jour d'un produit";
        $action = "update";
        require_once File::build_path(array("View","view.php"));
    }

    public static function updated(){
        $data = array(
            "idProduit" => $_POST["idProduit"],
            "nomProduit" => $_POST["nomProduit"],
            "descriptionProduit" => $_POST["descriptionProduit"],
            "idCategorie" => $_POST["idCategorie"],
            "prixProduit" => $_POST["prixProduit"],
            "quantiteProduit" => $_POST["quantiteProduit"]
        );

        if (!isset($_POST["idProduit"]) || !isset($_POST["nomProduit"]) || !isset($_POST["descriptionProduit"]) || !isset($_POST["idCategorie"]) || !isset($_POST["prixProduit"]) || !isset($_POST["quantiteProduit"]) || !ModelUtilisateur::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue en updatant le produit';
            require_once File::build_path(array("View", "view.php"));
        }

        $tab_uti = ModelUtilisateur::selectAll();
        $controller = self::$object;
        $view = 'updated';
        $pagetitle = "Le produit à été modifié";
        require_once File::build_path(array("View", "view.php"));
    }
}
?>