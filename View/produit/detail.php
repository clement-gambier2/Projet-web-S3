<?php

    $idP = rawurldecode($p->get('idProduit'));
    echo '<h2> Détails sur le produit ' . $p->get('nomProduit') . ' :</h2>' .
        '<p> Description : ' . $p->get('descriptionProduit') . '.<br>' .
        'Categorie : ' . $p->get('idCategorie') . '.<br>' . //afficher le nom de la catégorie plutot que le num
        'Prix : ' . $p->get('prixProduit') . '€.<br>' .
    'Quantité en stock : ' . $p->get('quantiteProduit') . '.</p>';

    echo '<a href="index.php?controller=Produit&&action=delete&&idProduit='. $idP .' "> Supprimer le produit </a><br>';
    echo '<a href="index.php?controller=Produit&&action=update&&idProduit='. $idP .' "> Modifier le produit </a>';
?>