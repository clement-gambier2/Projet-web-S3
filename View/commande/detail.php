<?php

require_once File::build_path(array("Model","ModelProduit.php"));
$idCommande = $idC;
$idUtilisateur = $_GET['idUtilisateur'];


echo '<h2> commande : ' . htmlspecialchars($idCommande) . '</h2>';

$prixTotal = 0;
$i = 0;

foreach ($l as $p) {
    $i ++;
    $idProduit = $p->get('idProduit');
    $nom = $p->get('nomProduit');
    $idCategorie = $p->get('idCategorie');
    $prix = $p->get('prixProduit');

    $prixTotal += $prix;

    echo '<p> Produit '. $i . ': idProduit :  ' . htmlspecialchars($idProduit) . '; nom :  ' . $nom . '; Categorie :  ' . $idCategorie . '; prix :  ' . $prix .'</p>';


}

echo '<p> Prix total : ' . $prixTotal . '</p>';


echo '</p> <a href="index.php?controller=commande&action=delete&idCommande=' . rawurlencode($idCommande) . ' "> supprimer la commande </a>';
echo '</p> <a href="index.php?controller=commande&action=update&idUtilisateur='. rawurlencode($idUtilisateur). '&idCommande=' . rawurlencode($idCommande) . ' "> modifier la commande </a>';

/*
echo '</p> <a href="index.php?controller=Utilisateur&&action=update&&idUtilisateur=' . $idurl . ' "> modifier l utilisateur </a>';
*/

?>