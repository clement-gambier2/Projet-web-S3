<?php
require_once File::build_path(Array("Model", "Model.php"));

class ModelCategorie extends Model{

    protected static $object = 'Categorie';
    protected static $primary = 'idCategorie';
    private $idCategorie;
    private $nomCategorie;




    // Getter générique
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    //Getter pour avoir le nom de la catégorie
    public function getNomCategorie($idCategorie){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);
        $rep = Model::getPDO()->query("SELECT nomCategorie 
        FROM Categorie
        WHERE idCategorie = " . $idCategorie);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $categorie = $rep->fetchColumn();

        if (empty($categorie))
            return false;
        return $categorie;
    }



    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($idCategorie = NULL, $nomCategorie = NULL) {
        if (!is_null($idCategorie) && !is_null($nomCategorie)) {
            $this->idCategorie = $idCategorie;
            $this->nomCategorie = $nomCategorie;

        }
    }

}

?>