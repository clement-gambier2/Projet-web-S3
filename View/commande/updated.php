<?php
echo '<p> La commande '. $idCommande . ' a bien été modifiée.</p>';
require_once File::build_path(array("view","commande","list.php"));
?>