<link rel="stylesheet" href="css/readAll.css">
<main>
    <table>
        <thead>
        <tr>
            <th>Nom Catégorie</th>
            <th>id Catégorie</th>
            <th>Modifier ?</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tab_cat as $c) {
            $nomCategorie = htmlspecialchars($c->get('nomCategorie'));
            $idCategorie = htmlspecialchars($c->get('idCategorie'));
            ?>
            <tr>
                <td><?php echo $nomCategorie;?></td>
                <td><?php echo $idCategorie;?></td>

                <td ><a href="index.php?action=update&controller=Categorie&idCategorie=<?php echo rawurlencode($c->get('idCategorie'))?>">🖋</a></td>
                <!--<td ><a href="index.php?action=delete&controller=Produit&idCategorie=<?php echo rawurlencode($c->get('idCategorie'))?>">❌</a></td>-->
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="button"><a href="index.php?action=create&controller=Produit">Créer un produit</a></div>
</main>






