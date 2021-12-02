<?php
    $size = ModelProduit::size();
    $tab  = array();
    for ($i = 1; $i <= 5; $i++) {
        $random = rand(1,$size);
        while(in_array($random,$tab)) { //Tant que random génère un nombre déjà trouvé il ressaye
            $random = rand(1,$size);
        }
        array_push($tab, $random);

        $p = ModelProduit::select($random);
        $idProduit = $p->get("idProduit");
        $idCategorie = $p->get("idCategorie");
        $nomCategorie = (new ModelCategorie)->getNomCategorie($idCategorie);
        ?>
        <div class="card">
            <img src="<?php echo $p->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $p->get("nomProduit") ?></p>
            <div class="market-detail">
<!--                <p>--><?php //echo " IdProduit : " . " " . $idProduit ?><!--</p>-->
                <?php echo $nomCategorie ?>
                <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>">Voir plus</a>
<!--                --><?php //echo $idCategorie ?>

            </div>
            <div class="button">
                <input type="submit" name="idProduit" value ="Ajouter au panier"/>
            </div>
        </div>
   <?php } ?>





?>



