<?php


    foreach($_SESSION['panier'] as $p){
        $produit = unserialize($p);
        echo "<p> nom du produit : " . $produit->get('nomProduit') . "</p>";
        echo "<p> prix du produit : " . $produit->get('prixProduit') . "</p>";

    }

?>
