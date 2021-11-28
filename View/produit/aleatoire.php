<?php
    $size = ModelProduit::size();
    $tab  = array();
    for ($i = 1; $i <= 6; $i++) {
        $random = rand(1,7);
        while(in_array($random,$tab)) { //Tant que random génère un nombre déjà trouvé il ressaye
            $random = rand(1,$size);
        }
        array_push($tab, $random);

        $p = ModelProduit::select($random);
        ?>
        <div class="card">
            <img src="<?php echo $p->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $p->get("nomProduit") ?></p>
            <div class="market-detail">
                <img src="ressources/profile.png" class="profil"">
                <p>Jungle </p>
                <?php echo " idProduit" . $p->get("idProduit") ?>
            </div>
            <div class="button">
                <input type="submit" name="idProduit" value ="Ajouter au panier"/>
            </div>
        </div>
   <?php } ?>


