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



?>