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
    /*
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
    */

    public static function delete($primary_value){
        $table_name = 'ProduitsCommande';
        $primary_key = static::$primary;
        try
        {
            $sql = "DELETE FROM " . $table_name . " WHERE " .$primary_key . "= :value";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array(
                "value" => $primary_value
            );

            $req_prep->execute($values);
        }
        catch(PDOException $e) {
            if (Config::getDebug()) {
                echo $e->getMessage()."<br>"; // affiche un message d'erreur
            }
            return false;
        }


        $table_name = static::$object;
        try
        {
            $sql = "DELETE FROM " . $table_name . " WHERE " .$primary_key . "= :value";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array(
                "value" => $primary_value
            );

            $req_prep->execute($values);
        }
        catch(PDOException $e) {
            if (Config::getDebug()) {
                echo $e->getMessage()."<br>"; // affiche un message d'erreur
            }
            return false;
        }

        return true;
    }


    public static function saveCommande($idUtilisateur , $product){
        $table_name = 'Commande';

        try
        {
            $values = array(
                "id" => $idUtilisateur,
            );

            $sql = "INSERT INTO " .  $table_name ."(`idCommande`, `idUtilisateur`, `dateCommande`)VALUES (NULL, :id , CURRENT_TIMESTAMP)";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute($values);





        }
        catch(PDOException $e) {
            if (Config::getDebug()) {
                echo $e->getMessage()."<br>"; // affiche un message d'erreur
            }
            return false;
        }
        return true;
    }


    public static function saveProduitsCommande($idUtilisateur , $product){

        $table_name = 'ProduitsCommande';


        try
        {
            $values = array(
                "id" => $idUtilisateur,
            );

            $idCommande = NULL;
            $sql = "SELECT * FROM Commande WHERE idUtilisateur = :id AND dateCommande = (SELECT max(dateCommande) FROM Commande WHERE idUtilisateur = :id)";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute($values);

            $class_name = "ModelCommande";

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $commandeTab = $req_prep->fetchAll();
            $commande = $commandeTab[0];

            $values = array(
                "idC" => $commande->get('idCommande'),
                "p" => $product,

            );
            $sql = "INSERT INTO " .  $table_name ."(`idCommande`, `idProduit`) VALUES (:idC , :p)";
            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute($values);


        }
        catch(PDOException $e) {
            if (Config::getDebug()) {
                echo $e->getMessage()."<br>"; // affiche un message d'erreur
            }
            return false;
        }
        return true;
    }


}



?>