<link rel="stylesheet" href="css/catalogue.css">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/navbar.css">

<main class="main-panier">

<?php

    $prixTotal = 0;

    if(isset($_SESSION['panier'])){
        foreach($_SESSION['panier'] as $p){

            $produit = unserialize($p);

            $idProduit = $produit->get("idProduit");
            $idCategorie = $produit->get("idCategorie");
            $nomProduit = $produit->get('nomProduit');

            $prixProduit = $produit->get('prixProduit');
            $prixTotal += $prixProduit;

            $nomCategorie = (new ModelCategorie)->getNomCategorie($idCategorie);
        ?>
            <div class='card-panier'>
                <img class="nft" src="<?php echo $produit->get("lienImage") ?>" alt="" class="nft"/>
                <p class = "p-panier"> nom du produit : <br><?php echo $nomProduit?></p>
                <p class = "p-panier"> prix du produit : <?php echo $prixProduit?></p>
                <form method="get">
                    <input type="hidden" name="action" value="supprimerDuPanier"/>
                    <input type="hidden" name="controller" value="Utilisateur"/>

                    <input type="hidden" name="idProduit" value="<?php echo $idProduit ?>"/>

                    <input class="button" type="submit" value = "Supprimer du panier"/></input>
                </form>
            </div>


          <?php
        }
        ?>
</main>
        <section id="order">
            <h2 id="prix-total">Le prix total est de : <?php echo $prixTotal?></h2>
            <form method="get" id="passer-commande">
                    <input type="hidden" name="action" value="createCommandePanier"/>
                    <input type="hidden" name="controller" value="Commande"/>
                    <input class="button" type="submit" value = "Passer la commande"/>
            </form>
        </section>
    <?php
    }
    else{
        echo "<h2>le pannier est vide !</h2>";
    }


?>

