<form action="index.php?action=search&controller=Produit&" method="post">
    <input name="recherche" id="search_bar" type="text" placeholder="Tapez un nom de produit">
    <input class="button" type="submit" value="Rechercher">
</form>

<section id="categorie-selector">
    <h3>Catégories</h3>

    <div id="selector">
        <a href="index.php?action=marketPlace&controller=Utilisateur">Tout</a>
        <?php

        foreach ($tab_cat as $c) {
            $nomCategorie = htmlspecialchars($c->get('nomCategorie'));
            $idCategorie = htmlspecialchars($c->get('idCategorie'));
            ?>
            <a href="index.php?action=getByCategories&controller=Produit&categorie=<?php echo $idCategorie ?>"> <?php echo $nomCategorie ?></a>
        <?php } ?>
    </div>


</section>