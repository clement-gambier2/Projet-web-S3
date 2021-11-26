<?php
require_once File::build_path(array("Model","ModelAdmin.php"));
class ControllerAdmin {
    protected static $object = "admin";


    public static function afficher() {
        $controller = static::$object;
        $view = "list";
        $pagetitle = "Espace Administrateur";
        $list = File::build_path(array("View","view.php"));
        require $list;
    }



}




?>
