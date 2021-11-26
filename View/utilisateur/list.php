<link rel="stylesheet" href="css/readAll.css">
<main>
<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Mot de passe</th>
            <th>Modifier ?</th>
            <th>Supprimer ?</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tab_uti as $v) { ?>
            <tr>
                <td><?php echo htmlspecialchars($v->getPseudo())?></td>
                <td><?php echo htmlspecialchars($v->getPrenom())?></td>
                <td><?php echo htmlspecialchars($v->getNom())?></td>
                <td><?php echo htmlspecialchars($v->getMail())?></td>
                <td><?php echo htmlspecialchars($v->getMotDePasseUtilisateur())?></td>
                <td ><a href="index.php?action=update&controller=Utilisateur&idUtilisateur=<?php echo $v->getIdUtilisateur()?>">🖋</a></td>
                <td ><a href="index.php?action=delete&controller=Utilisateur&idUtilisateur=<?php echo $v->getIdUtilisateur()?>">❌</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
    <div class="button"><a href="index.php?action=create&controller=Utilisateur">Créer un utilisateur</a></div>
</main>




