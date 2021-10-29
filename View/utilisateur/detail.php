<?php
    $loginplus = htmlspecialchars($l->getIdUtilisateur());
    $loginurl = rawurlencode($l->getIdUtilisateur());
    echo '<p> Nom :  ' . $l->getPseudo() . '.</p>';
    echo '<p> Prenom ' . $l->getprenom() . '.</p>';

    echo '</p> <a href="index.php?action=delete&&login='. $loginurl.' "> supprimer l utilisateur </a>';

    echo '</p> <a href="index.php?controller=utilisateur&&action=update&&login='. $loginurl.' "> modifier l utilisateur </a>';
?>

