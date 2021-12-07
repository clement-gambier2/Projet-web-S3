<?php
    foreach($tab_prod as $p) {
        $idProduit = $p->get("idProduit");
        $idCategorie = $p->get("idCategorie");
        $nomCategorie = (new ModelCategorie)->getNomCategorie($idCategorie);
?>

        <div class="card">
            <img src="<?php echo $p->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $p->get("nomProduit") ?></p>
            <div class="market-detail">
                <p><?php echo $nomCategorie ?></p>
                <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>"><p>Voir plus</p></a>
            </div>
            <form method="get"  >
                <input type="hidden" name="action" value="ajouterAuPanier"/>
                <input type="hidden" name="controller" value="Utilisateur"/>

                <input type="hidden" name="idProduit" value="<?php echo $idProduit ?>"/>

                <input class="button" type="submit" value = "Ajouter au panier"/>
            </form>
        </div>
   <?php } ?>








