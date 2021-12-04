<?php

require_once File::build_path(array("Model","ModelUtilisateur.php"));

require_once File::build_path(array("Lib","Security.php"));
require_once File::build_path(array("Lib","Session.php"));

class ControllerStatic
{
    protected static $object = "static";

    public static function home() {

        $controller = static::$object;
        $view = "home";
        $pagetitle = "Accueil";
        $list = File::build_path(array("View","view.php"));
        require $list;
    }

}