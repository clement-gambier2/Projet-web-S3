<?php

foreach($tab_p as $p) {
    $idProduit = $p->get('idProduit');
    $nom = $p->get('nomProduit');

    echo "<p> Produit : " . htmlspecialchars($nom) . ", <a href='index.php?action=read&controller=Produit&idProduit=" . rawurlencode($idProduit) . "'>Cliquez pour détails</a>" . '</p>';
}
?>