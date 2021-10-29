<?php
    require_once File::build_path(Array("model", "Model.php"));

class ModelProduit extends Model{


    protected static $object = 'produit';
    protected static $primary = 'idProduit';
    private $idProduit;
    private $nom;
    private $idCategorie;
    private $description;
    private $prix;
   
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
    public function __construct($idP = NULL, $n = NULL, $idC = NULL, $d = NULL, $p = NULL) {
        if (!is_null($idP) && !is_null($n) && !is_null($idC) && !is_null($p)) {
          // Si aucun de $m, $c et $i sont nuls,
          // c'est forcement qu'on les a fournis
          // donc on retombe sur le constructeur à 3 arguments
          $this->idProduit = $idP;
          $this->nom = $n;
          $this->idCategorie = $idC;
          $this->description = $d;
          $this->prix = $p;
        }
    }

    /*
    // une methode d'affichage.
    public function afficher() {
      // À compléter dans le prochain exercice

      echo "Marque $this->marque <br/>";
      echo "Couleur $this->couleur <br/>";
      echo "Matricule $this->immatriculation <br/>";
    }
    */


    
    public function save(){

        $sql = "INSERT INTO Produit (idProduit, nomProduit, descriptionProduit, idCategorie, prix) VALUES(:idP, :n, :d, :idC, :p)";

        $rep_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "idP" => $this->idProduit,
            "n" => $this->nom,
            "d" => $this->description,
            "idC" => $this->idCategorie,
            "p" => $this->prix,
        );

        $rep_prep->execute($values);


    }


    

}

?>