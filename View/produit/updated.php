<?php
    echo '<p>Le produit '. $nomProduit . ' a bien été modifié.</p>';
    require_once File::build_path(array("View","produit","list.php"));
?>