<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once 'Lib/File.php';
    require_once File::build_path(array("Controller", "routeur.php"));
?>
