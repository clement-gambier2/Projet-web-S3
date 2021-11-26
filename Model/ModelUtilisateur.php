<?php
    require_once File::build_path(Array("Model", "Model.php"));

class ModelUtilisateur extends Model{

    protected static $object = 'Utilisateur';
    protected static $primary = 'idUtilisateur';
    private $idUtilisateur;
    private $pseudo;
    private $prenomUtilisateur;
    private $nomutilisateur;
    private $mailUtilisateur;
    private $motDePasseUtilisateur;

    public static function checkPassword($login, $mdp_hache) {
        // faire une requête qui va checker dans la bdd si il couple $login $mdp existe
        $requete = Model::getPDO()->query('SELECT * FROM Utilisateur WHERE pseudo= "' . $login . '" AND motDePasseUtilisateur="' . $mdp_hache . '"');
        $requete->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');

        return $requete->fetchAll() != '';
    }

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
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $email = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom)&& !is_null($login)&& !is_null($email)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->login = $login;
            $this->email = $email;
        }
    }



}



/* Anciens Getters et Setters

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPrenom()
    {
        return $this->prenomUtilisateur;
    }

    public function getNom()
    {
        return $this->nomutilisateur;
    }

    public function getMail()
    {
        return $this->mailUtilisateur;
    }

    public function getMotDePasseUtilisateur()
    {
        return $this->motDePasseUtilisateur;
    }*/

?>