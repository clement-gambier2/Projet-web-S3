<?php
    require_once File::build_path(Array("Model", "Model.php"));

class ModelUtilisateur extends Model{

    protected static $object = 'Utilisateur';
    protected static $primary = 'idUtilisateur';
    private $idUtilisateur;
    private $pseudo;
    private $prenom;
    private $nom;
    private $mail;

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
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