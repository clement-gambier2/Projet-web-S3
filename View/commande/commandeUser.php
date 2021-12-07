<link rel="stylesheet" href="css/readAll.css">

<main>
    <table>
        <thead>
        <tr>
            <th>Numéro de commande</th>
            <th>Voir plus</th>
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

                <td><a href='index.php?action=read&type=user&controller=Commande&idCommande=<?php echo $idCommande;?>&idUtilisateur=<?php echo $idUtilisateur;?>'>Voir plus</a></td>
                <td ><a href='index.php?controller=commande&action=delete&mesCommande=1&idCommande=<?php echo $idCommande;?>'>❌</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>
