<link rel="stylesheet" href="css/readAll.css">

<main>
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
            $idUtilisateur = rawurlencode($c->get('idUtilisateur'));
            $idCommande = rawurlencode($c->get('idCommande'));
            ?>
            <tr>
                <td><?php echo htmlspecialchars($idCommande); ?></td>

                <td><?php echo htmlspecialchars($idUtilisateur); ?></td>
                <td><a href='index.php?action=read&controller=Commande&idCommande=<?php echo $idCommande;?>&idUtilisateur=<?php echo $idUtilisateur;?>'>Voir plus</a></td>
                <td ><a href='index.php?action=update&controller=Commande&idCommande=<?php echo $idCommande;?>&idUtilisateur=<?php echo $idUtilisateur;?>'>🖋</a></td>
                <td ><a href='index.php?controller=commande&action=delete&idCommande=<?php echo $idCommande;?>'>❌</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="button"><a href="index.php?action=create&controller=Commande">Créer une commande</a></div>
</main>
