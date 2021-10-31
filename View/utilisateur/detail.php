<?php

    $idurl = rawurlencode($l->getIdUtilisateur());
    echo '<p> Pseudo :  ' . $l->getPseudo() . '</p>';
    echo '<p> Prenom : ' . $l->getPrenom() . '</p>';
    echo '<p> Nom :  ' . $l->getNom() .'</p>';
    echo '<p> Mail : ' . $l->getMail() . '</p>';
    echo '<p> Mot de passe : ' . $l->getMotDePasseUtilisateur() . '</p>';


    echo '</p> <a href="index.php?action=delete&&idUtilisateur='. $idurl .' "> supprimer l utilisateur </a>';

    echo '</p> <a href="index.php?controller=Utilisateur&&action=update&&idUtilisateur='. $idurl .' "> modifier l utilisateur </a>';
?>

