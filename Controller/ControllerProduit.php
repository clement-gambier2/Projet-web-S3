<?php
require_once File::build_path(Array("Model", "ModelProduit.php"));
require_once File::build_path(Array("Model", "ModelCategorie.php"));

class ControllerProduit
{

    protected static $object = 'produit';

    public static function readAll()
    {
        $tab_p = ModelProduit::selectAll();     //appel au modèle pour gerer la BD

        $controller = static::$object;
        $view = 'list';
        $pagetitle = 'Liste des produits';

        $list = File::build_path(array("View", "view.php"));
        require $list;
    }

    public static function read()
    {

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

    public static function create()
    {
        $controller = 'produit';
        $tab_categorie = ModelCategorie::selectAll();
        $view = 'update';
        $action = "created";
        $pagetitle = 'Création d\'un produit';

        require_once File::build_path(array("View", "view.php"));
    }

    public static function created()
    {

        //récupérer les donnés de la voiture à partir de la query string
        $data = array(
            "nomProduit" => $_POST["nomProduit"],
            "descriptionProduit" => $_POST["descriptionProduit"],
            "idCategorie" => $_POST["idCategorie"],
            "prixProduit" => $_POST["prixProduit"],
            "quantiteProduit" => $_POST["quantiteProduit"]
        );
        if (ModelProduit::save($data)) {
            $tab_p = ModelProduit::selectAll();
            $controller = self::$object;
            $view = 'created';
            $pagetitle = 'Produit créé';
            require_once File::build_path(array("View", "view.php"));
        } else {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue';
            require_once File::build_path(array("View", "view.php"));
        }
    }

    public static function delete()
    {
        $idP = $_GET['idProduit'];

        $p = ModelProduit::select($idP);
        $p->delete($idP);

        $tab_p = ModelProduit::selectAll();

        $controller = 'produit';
        $view = 'deleted';
        $pagetitle = 'Supprimer un produit';
        require_once File::build_path(array("view", "produit", "deleted.php"));
    }

    public static function update()
    {
        $controller = static::$object;
        $idProduit = $_GET['idProduit'];
        $idCategorie = $_GET['idCategorie'];
        $tab_categorie = ModelCategorie::selectAll();

        $view = "update";
        $pagetitle = "Mise à jour d'un produit";
        $action = "updated";
        require_once File::build_path(array("View", "view.php"));
    }

    public static function updated()
    {

        $nomProduit = $_POST['nomProduit'];

        $data = array(
            "idProduit" => $_POST['idProduit'],
            "nomProduit" => $nomProduit,
            "descriptionProduit" => $_POST['descriptionProduit'],
            "idCategorie" => $_POST['idCategorie'],
            "prixProduit" => $_POST['prixProduit'],
            "quantiteProduit" => $_POST['quantiteProduit'],
            "lienImage" => $_POST['lienImage']

        );


        if (!isset($_POST["idProduit"]) || !isset($_POST["nomProduit"]) || !isset($_POST["descriptionProduit"]) || !isset($_POST["idCategorie"]) || !isset($_POST["prixProduit"]) || !isset($_POST["quantiteProduit"]) || !isset($_POST["lienImage"]) || !ModelProduit::update($data)) {
            $controller = self::$object;
            $view = 'error';
            $pagetitle = 'Une erreur est survenue en updatant le produit';
            require_once File::build_path(array("View", "view.php"));
        }

        $tab_p = ModelProduit::selectAll();
        $controller = self::$object;
        $view = 'updated';
        $pagetitle = "Le produit à été modifié";
        require_once File::build_path(array("View", "view.php"));
    }

    public static function search(){
        $recherche = $_POST['recherche'];
        $resulat = ModelProduit::search($recherche);
//        echo var_dump($resulat);
        $p = ModelProduit::select($resulat);
        $controller = self::$object;
        $view = 'search';
        $pagetitle = "Résultat de la recherche";
        require_once File::build_path(array("View", "view.php"));
    }

    public static function getByCategories(){
        $categorie = $_GET['categorie'];
        $produits = ModelProduit::getByCategories($categorie);
        $controller = self::$object;
        $view = 'categorie';
        $pagetitle = "Résultat de la recherche";
        require_once File::build_path(array("View", "view.php"));
    }


}