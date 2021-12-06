<?php
    require_once File::build_path(Array("Model", "Model.php"));

class ModelProduit extends Model
{


    protected static $object = 'Produit';
    protected static $primary = 'idProduit';
    private $idProduit;
    private $nomProduit;
    private $descriptionProduit;
    private $idCategorie;
    private $prixProduit;
    private $lienImage;

    // Getter générique
    public function get($nom_attribut)
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur)
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($idP = NULL, $n = NULL, $d = NULL, $idC = NULL, $p = NULL, $l = NULL)
    {
        if (!is_null($idP) && !is_null($n) && !is_null($idC) && !is_null($p) && !is_null($l)) {
            // Si aucun de $idP, $n, $idC, $p et $q sont nuls,
            // c'est forcement qu'on les a fournis
            // donc on retombe sur le constructeur à 3 arguments
            $this->idProduit = $idP;
            $this->nomProduit = $n;
            $this->descriptionProduit = $d;
            $this->idCategorie = $idC;
            $this->prixProduit = $p;
            $this->lienImage = $l;

        }
    }

    public static function getAllProduits($primary_value)
    {
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);

        $sql = "SELECT p.idProduit, p.nomProduit, p.descriptionProduit, p.idCategorie, p.prixProduit
                FROM " . $table_name . " p 
                JOIN ProduitsCommande pc ON p.idProduit = pc.idProduit
                JOIN Commande c ON pc.idCommande = c.idCommande
                WHERE c.idCommande = :value";

        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "value" => $primary_value,
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();

        return $tab;
    }

    public static function search($nomProduit)
    {
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);
        $sql = "SELECT idProduit FROM Produit WHERE nomProduit LIKE '%$nomProduit%'";
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchColumn();
        return $tab;
    }


    public static function size(){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);

        $sql = "SELECT COUNT(*) FROM $table_name";

        $req_prep = Model::getPDO()->prepare($sql);



        $req_prep->execute();

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        return $req_prep->fetchColumn();
    }

    public static function getByCategories($categorie){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);

        $sql = "SELECT idProduit FROM $table_name WHERE idCategorie = $categorie";

        $req_prep = Model::getPDO()->prepare($sql);



        $req_prep->execute();

        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        return $req_prep->fetchAll();
    }
}