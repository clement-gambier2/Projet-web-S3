<?php

//echo var_dump($tab_uti);
foreach ($tab_uti as $v) {
    $idUtilisateur = $v->getIdUtilisateur();
    $pseudo = $v->getPseudo();

    echo '<p>' . htmlspecialchars($pseudo) .
        " <a href='index.php?action=read&controller=Utilisateur&idUtilisateur=" . rawurlencode($idUtilisateur) . "'>Detail</a>" . '</p>';
}
?>




