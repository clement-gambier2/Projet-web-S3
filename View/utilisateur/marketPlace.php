<link rel="stylesheet" href="css/catalogue.css">
<form method="get"  >
    <input type="hidden" name="action" value="ajouterAuPanier"/>
    <input type="hidden" name="controller" value="Utilisateur"/>

    <main>
<?php
    foreach ($tab_prod as $prod){
        $idProduit = $prod->get("idProduit");
        $idCategorie = $prod->get("idCategorie");
        $nomCategorie = (new ModelCategorie)->getNomCategorie($idCategorie);

        ?>

        <div class="card">
            <img src="<?php echo $prod->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $prod->get("nomProduit") ?></p>
            <div class="market-detail">
                <p><?php echo " IdProduit : " . " " . $idProduit ?></p>
                <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>">Voir plus</a>
                <?php echo $idCategorie ?>
                <?php echo $nomCategorie ?>
            </div>
            <div class="button">
                <input type="submit" name="idProduit" value ="Ajouter au panier"/>
            </div>
        </div>


    <?php } ?>
    </main>
</form>