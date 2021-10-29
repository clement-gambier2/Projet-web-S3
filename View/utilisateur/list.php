<?php

//echo var_dump($tab_uti);
foreach ($tab_uti as $v) {
    $idUtilisateur = $v->getIdUtilisateur();
    $nom = $v->getNom();
    $pseudo = $v->getPseudo();
    $prenom = $v->getPrenom();
    $mail = $v->getMail();


    echo '<p>' . htmlspecialchars($pseudo) .
        " <a href='index.php?action=read&controller=Utilisateur&idUtilisateur=" . rawurlencode($idUtilisateur) . "'>Detail</a>" . '</p>';
}
?>




