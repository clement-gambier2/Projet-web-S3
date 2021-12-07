<?php
echo '<p>La commande à bien été annulée.</p>';
if($action == "mesCommandes"){
    require_once File::build_path(array("View","commande","commandeUser.php"));
}
else{
    require_once File::build_path(array("View","commande","list.php"));

}
?>