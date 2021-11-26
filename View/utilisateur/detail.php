<?php

    $idurl = rawurlencode($l->get('idUtilisateur'));
    $pseudo = rawurlencode($l->get('idUtilisateur'));
    echo '<p> Pseudo :  ' . $l->get('pseudo') . '</p>';
    echo '<p> Prenom : ' . $l->get('prenomUtilisateur') . '</p>';
    echo '<p> Nom :  ' . $l->get('nomUtilisateur') .'</p>';
    echo '<p> Mail : ' . $l->get('mailUtilisateur') . '</p>';
    echo '<p> Mot de passe : ' . $l->get('motDePasseUtilisateur') . '</p>';


    echo '</p> <a href="index.php?action=delete&&idUtilisateur='. $idurl .' "> Supprimer l\'utilisateur </a>';

    echo '</p> <a href="index.php?controller=Utilisateur&&action=update&&idUtilisateur='. $idurl .'&&pseudo='. $pseudo .' "> Modifier l\'utilisateur </a>';
?>

