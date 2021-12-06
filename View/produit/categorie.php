<link rel="stylesheet" href="css/catalogue.css">
<?php
$cat = ModelCategorie::select($_GET["categorie"]);
$nomCategorie = $cat->get("nomCategorie");
?>
<h2>Catégorie : <?php echo $nomCategorie ?></h2>

<?php
include "View/produit/categorie-selector.php";
?>

<main>

    <?php foreach ($produits as $p) {
        $idProduit = $p->get('idProduit');
        $prod = ModelProduit::select($idProduit);
        $cat = ModelCategorie::select($_GET["categorie"]);
        $nomCategorie = $cat->get("nomCategorie");
    ?>
        <div class="card">
            <img src="<?php echo $prod->get("lienImage") ?>" alt="" class="nft"/>
            <p><?php echo $prod->get("nomProduit") ?></p>
            <div class="market-detail">
                <p><?php echo $nomCategorie ?></p>
                <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>"><p>Voir plus</p></a>
            </div>
            <form method="get">
                <input type="hidden" name="action" value="ajouterAuPanier"/>
                <input type="hidden" name="controller" value="Utilisateur"/>

                <input type="hidden" name="idProduit" value="<?php echo $idProduit ?>"/>

                <input class="button" type="submit" value = "Ajouter au panier"/>
            </form>
        </div>

    <?php } ?>
</main>






