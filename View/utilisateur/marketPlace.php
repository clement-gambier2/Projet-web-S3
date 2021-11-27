<link rel="stylesheet" href="css/catalogue.css">
<form method="get"  action="index.php?action=ajouterAuPanier&controller=Utilisateur">
    <input type="hidden" name="action" value="ajouterAuPanier"/>
    <input type="hidden" name="controller" value="Utilisateur"/>

    <main>
<?php
    foreach ($tab_prod as $prod){ ?>
        <div class="card">
            <img src="<?php echo $prod->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $prod->get("nomProduit") ?></p>
            <div class="picture-profil">
                <img src="ressources/profile.png" class="profil"">
                <p>Jungle </p>
                <?php echo " idProduit" . $prod->get("idProduit") ?>
            </div>
            <div class="button">
                <input type="submit" name="idProduit" value ="Ajouter au panier"/>

            </div>
        </div>

    <?php } ?>
    </main>
</form>