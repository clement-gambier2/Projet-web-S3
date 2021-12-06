<?php

require_once File::build_path(array("Model","ModelUtilisateur.php"));

require_once File::build_path(array("Lib","Security.php"));
require_once File::build_path(array("Lib","Session.php"));

class ControllerStatic
{
    protected static $object = "static";

    public static function home() {
        //Pour réaliser la page aléatoire car on fait un include de aleatoire dans la page home
        $size = ModelProduit::size();
        $tab  = array();
        $tab_prod = array();
        for ($i = 1; $i <= 5; $i++) {
            $random = rand(1, $size);
            while (in_array($random, $tab)) { //Tant que random génère un nombre déjà trouvé il ressaye
                $random = rand(1, $size);
            }
            array_push($tab, $random);

            $p = ModelProduit::select($random);
            array_push($tab_prod,$p);

        }


        //Pour afficher la page
        $controller = static::$object;
        $view = "home";
        $pagetitle = "Accueil";
        $list = File::build_path(array("View","view.php"));
        require $list;
    }

}