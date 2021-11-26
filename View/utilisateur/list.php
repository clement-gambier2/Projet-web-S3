<link rel="stylesheet" href="css/readAll.css">
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
        <?php foreach ($tab_uti as $u) {
            $idurl = rawurlencode($u->get('idUtilisateur'));
            $pseudo = rawurlencode($u->get('pseudo'));
            ?>
            <tr>
                <td><?php echo htmlspecialchars($u->get('pseudo'))?></td>
                <td><?php echo htmlspecialchars($u->get('prenomUtilisateur'))?></td>
                <td><?php echo htmlspecialchars($u->get('nomUtilisateur'))?></td>
                <td><?php echo htmlspecialchars($u->get('mailUtilisateur'))?></td>
                <td><?php echo htmlspecialchars($u->get('motDePasseUtilisateur'))?></td>
                <td ><a href="index.php?controller=utilisateur&action=update&idUtilisateur=<?php echo $idurl ?>&pseudo=<?php echo $pseudo ?>">🖋</a></td>
                <td ><a href="index.php?controller=utilisateur&action=delete&idUtilisateur=<?php echo $idurl ?>"> ❌ </a></td>
            </tr>
        <?php } ?>
        <tr>
            <td><a href="index.php?action=create&controller=Utilisateur">Créer un utilisateur</a></td>
        </tr>
    </tbody>
</table>





