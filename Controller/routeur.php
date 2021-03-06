<?php
require_once File::build_path(array("Controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("Controller", "ControllerCommande.php"));
require_once File::build_path(array("Controller", "ControllerProduit.php"));
require_once File::build_path(array("Controller", "ControllerAdmin.php"));
require_once File::build_path(array("Controller", "ControllerCategorie.php"));
require_once File::build_path(array("Controller", "ControllerStatic.php"));


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
    //echo "Barre de recherche marche pas";
    $controller='static';
    $view='error';
    $pagetitle='Une erreur est survenue dans le routeur';
    require_once File::build_path(Array("View", "view.php"));
}

?>