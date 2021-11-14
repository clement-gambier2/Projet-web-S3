<?php
    require_once "Config/Config.php";

class Model {
    private static $pdo = NULL;
    protected static $object;
    protected static $primary;

    public static function init(){

        $hostname = Config::getHostname();
        $database_name = Config::getDatabase();
        $login = Config::getLogin();
        $password = Config::getPassword();
        
        try{
            // Le dernier argument sert à ce que toutes les chaines de caractères 
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,
                                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } 
          catch (PDOException $e) {
            if (Config::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            } else {
              echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
          }
    }
    
    public static function getPDO(){
        if(is_null(self::$pdo)){
            self::init();
        }
        return self::$pdo;
    }
    public static function selectAll(){
      $table_name = static::$object;
      $class_name = "Model" . ucfirst($table_name);
      $rep = Model::getPDO()->query("SELECT * FROM ". $table_name );
      $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab = $rep->fetchAll();
      return $tab;
  }

    public static function select($primary_value){
      $table_name = static::$object;
      $class_name = "Model" . ucfirst($table_name);
      $primary_key = static::$primary;

      $sql = "SELECT * from ". $table_name ." WHERE " . $primary_key . "= :value";
      // Préparation de la requête
      $req_prep = Model::getPDO()->prepare($sql);

      $values = array(
          "value" => $primary_value,
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


    public static function delete($primary_value){
        $table_name = static::$object;
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
        return true;
    }

    public static function update($data){

        $table_name = static::$object;
        $primary_key = static::$primary;

        try{
            $values = array(
                "value" => $data[$primary_key]
            );
            
            $column_name = "";
            foreach ($data as $key => $valeur){
                if($column_name != "") $column_name = $column_name . ", ";
                $column_name = $column_name . $key . "='" . $valeur."'";
            }
            
            $sql = "UPDATE " . $table_name . " SET " . $column_name . " WHERE " . $primary_key . " = :value";
            $req_prep = Model::getPDO()->prepare($sql);
            
            $req_prep->execute($values);
        }
        catch (PDOException $e) {
            if(Config::getDebug()){
                echo $e->getMessage(); // affiche un message d'erreur'
            }
            else{
                echo "une erreur est survenue";
            }
            return false;
        }
        return true;
    }

    public static function save($data){
        $table_name = static::$object;
        $primary_key = static::$primary;  

        try
        {
            $values = array();
            $autreClé = "";
            $autreCléValeur = "";
            foreach ($data as $key => $valeur)
            {
                if($autreClé != ""){
                    $autreClé = $autreClé . ", ";
                } 
                $autreClé = $autreClé . $key;
                if($autreCléValeur != "") $autreCléValeur = $autreCléValeur . ", ";
                $autreCléValeur = $autreCléValeur . ":" . $key;
                $values[$key] = $valeur;
            }


            $sql = "INSERT INTO " . $table_name . " (" . $autreClé . ") VALUES (" . $autreCléValeur . ")";
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