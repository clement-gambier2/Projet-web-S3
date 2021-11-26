<link rel="stylesheet" href="css/readAll.css">
<main>
<table>
    <thead>
    <tr>
        <th>Nom du produit</th>
        <th>Description du produit</th>
        <th>Id Catégorie</th>
        <th>Prix du produit</th>
        <th>Quantité produit</th>
        <th>Modifier ?</th>
        <th>Supprimer ?</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tab_p as $p) { ?>
        <tr>
            <td><?php echo htmlspecialchars($p->get('nomProduit'))?></td>
            <td><?php echo htmlspecialchars($p->get('descriptionProduit'))?></td>
            <td><?php echo htmlspecialchars($p->get('idCategorie'))?></td>
            <td><?php echo htmlspecialchars($p->get('prixProduit'))?></td>
            <td><?php echo htmlspecialchars($p->get('quantiteProduit'))?></td>
            <td ><a href="index.php?action=update&controller=Produit&idProduit=<?php echo $p->get('idProduit')?>">🖋</a></td>
            <td ><a href="index.php?action=delete&controller=Produit&idProduit=<?php echo $p->get('idProduit')?>">❌</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div class="button"><a href="index.php?action=create&controller=Produit">Créer un produit</a></div>
</main>






