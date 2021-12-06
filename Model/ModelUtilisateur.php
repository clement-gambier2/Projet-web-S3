<?php
    require_once File::build_path(Array("Model", "Model.php"));

class ModelUtilisateur extends Model{

    protected static $object = 'Utilisateur';
    protected static $primary = 'idUtilisateur';
    private $idUtilisateur;
    private $pseudo;
    private $prenomUtilisateur;
    private $nomUtilisateur;
    private $mailUtilisateur;
    private $motDePasseUtilisateur;

    public static function checkPassword($login, $mdp_hache) {
        $requete = Model::getPDO()->query('SELECT idUtilisateur FROM Utilisateur WHERE pseudo= "' . $login . '" AND motDePasseUtilisateur="' . $mdp_hache . '"');

        return $requete->fetchColumn() != false;
    }

    public static function checkMail($login) {
        $requete = Model::getPDO()->query('SELECT nonce FROM Utilisateur WHERE pseudo="' . $login . '"');
        return $requete->fetchColumn() == NULL;
    }

    public static function isAdmin($login) {
        $requete = Model::getPDO()->query('SELECT isAdmin FROM Utilisateur WHERE pseudo= "' . $login . '"');

        return $requete->fetchColumn() == 1;
    }


    public static function selectWithPseudo($pseudo){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);
        $primary_key = "pseudo";

        $sql = "SELECT * from ". $table_name ." WHERE " . $primary_key . "= :value";
        // Préparation de la requête
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "value" => $pseudo,
        );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_user = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_user))
            return false;
        return $tab_user[0];

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