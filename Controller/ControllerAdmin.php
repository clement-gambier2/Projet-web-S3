<?php
require_once File::build_path(array("Model","ModelAdmin.php"));
class ControllerAdmin {
    protected static $object = "admin";


    public static function afficher() {
        if ($_SESSION['admin'] == 1) {
            $controller = static::$object;
            $view = "list";
            $pagetitle = "Espace Administrateur";
            $list = File::build_path(array("View","view.php"));
            require $list;
        } else {
            $controller = "utilisateur";
            $view = "connect";
            $pagetitle = "Connectez vous pour accéder au panel admin";
            $list = File::build_path(array("View","view.php"));
            require $list;
        }

    }



}




?>
