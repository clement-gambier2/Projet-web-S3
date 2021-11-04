<?php
    require_once File::build_path(Array("Model", "Model.php"));
require_once File::build_path(Array("Model", "ModelProduit.php"));

class ModelCommande extends Model{

    protected static $object = 'Commande';
    protected static $primary = 'idCommande';

    private $idCommande;
    private $idUtilisateur;
    private $dateCommande;

    // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($idUtilisateur = NULL, $idCommande = NULL, $dateCommande = NULL) {
        if (!is_null($idUtilisateur) && !is_null($idCommande)) {
            $this->idUtilisateur = $idUtilisateur;
            $this->idCommande = $idCommande;
            $this->dateCommande = $dateCommande;
        }
    }

    public static function getAllProduits($primary_value){
        $table_name = "Produit";
        $class_name = "Model" . ucfirst($table_name);

        $sql = "SELECT p.idProduit, p.nomProduit, p.descriptionProduit, p.idCategorie, p.prixProduit, p.quantiteProduit 
                FROM ". $table_name . " p 
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


}



?>