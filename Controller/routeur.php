<?php
require_once File::build_path(array("Controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("Controller", "ControllerCommande.php"));
require_once File::build_path(array("Controller", "ControllerProduit.php"));
require_once File::build_path(array("Controller", "ControllerAdmin.php"));

$action = "home";
if(isset($_GET["action"])) $action = $_GET["action"];

$controller = "static";
if(isset($_GET["controller"])){
    $controller = $_GET["controller"];
}

$controller_class = "Controller" . ucfirst($controller);



if(class_exists($controller_class) && in_array($action, get_class_methods($controller_class))) {
    require_once File::build_path(array("Controller", $controller_class . ".php"));
    $controller_class::$action();
}
else {
    $controller='static';
    $view='home';
    $pagetitle='Une erreur est survenue';
    require_once File::build_path(Array("View", "view.php"));
}

?>