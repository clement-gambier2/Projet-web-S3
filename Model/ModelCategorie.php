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