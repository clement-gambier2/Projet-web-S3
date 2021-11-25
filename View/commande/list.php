<?php

//echo var_dump($tab_uti);
foreach ($tab_com as $c) {
    $idUtilisateur = $c->get('idUtilisateur');
    $idCommande = $c->get('idCommande');

    echo '<p>' . "commande numero " . htmlspecialchars($idCommande) . " par le user $idUtilisateur" . " <a href='index.php?action=read&idUtilisateur= ". rawurlencode($idUtilisateur) ."&controller=Commande&idCommande=" . rawurlencode($idCommande) . "'>Detail</a>" . '</p>';
}
?>