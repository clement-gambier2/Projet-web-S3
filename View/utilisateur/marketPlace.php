<?php


    echo '<form method="get" class="glass2" action="index.php?action=ajouterAuPanier&controller=Utilisateur">';
    echo '<input type="hidden" name="action" value="ajouterAuPanier"/>';
    echo '<input type="hidden" name="controller" value="Utilisateur"/>';


    foreach ($tab_prod as $prod){
        echo '<p>' . $prod->get("nomProduit") . '</p>';
        echo '<p>' . $prod->get("idProduit") . '</p>';
        echo '<input type="submit" name="idProduit" value ="'. $prod->get("idProduit") . '"/>Ajouter au panier</input>';
    }

    echo '</form>';
?>