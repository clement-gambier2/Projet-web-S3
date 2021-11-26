<link rel="stylesheet" href="css/readAll.css">
<table>
    <thead>
    <tr>
        <th>Numéro de commande</th>
        <th>Utilisateur</th>
        <th>Voir plus</th>
        <th>Modifier ?</th>
        <th>Supprimer ?</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tab_com as $c) {
        $idUtilisateur = $c->get('idUtilisateur');
        $idCommande = rawurlencode($c->get('idCommande'));
        ?>
        <tr>
            <td><?php echo htmlspecialchars($idUtilisateur); ?></td>
            <td><?php echo htmlspecialchars($idCommande); ?></td>
            <td><a href='index.php?action=read&controller=Commande&idCommande=<?php echo $idCommande;?>'>Voir plus</a></td>
            <td ><a href="">🖋</a></td>
            <td ><a href="">❌</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

