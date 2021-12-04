<link rel="stylesheet" href="css/catalogue.css">


<h2>Catalogue</h2>
<form action="index.php?action=search&controller=Produit&" method="post">
    <input name="recherche" id="recherche" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
</form>


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
<!--                <p>--><?php //echo " IdProduit : " . " " . $idProduit ?><!--</p>-->
                <?php echo $nomCategorie ?>
                <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>">Voir plus</a>
<!--                --><?php //echo $idCategorie ?>

            </div>
            <button type="submit" name="idProduit" class="button">Ajouter au panier</button>
<!--                <input type="submit" name="idProduit" value ="Ajouter au panier" style="background-color: #3c1053"/>-->
        </div>


    <?php } ?>
    </main>
</form>