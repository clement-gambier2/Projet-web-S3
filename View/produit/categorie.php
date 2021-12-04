<link rel="stylesheet" href="css/catalogue.css">
<?php $nomCategorie = (new ModelCategorie)->getNomCategorie($categorie); ?>

<h2>Catégorie : <?php echo $nomCategorie ?></h2>

<?php
include "View/produit/categorie-selector.php";
?>

<main>

<?php foreach ($produits as $p) {
    $idProduit = $p->get('idProduit');
    $generique_produit = ModelProduit::select($idProduit);
    $idCategorie = $generique_produit->get("idCategorie");

    ?>
<div class="card">
<img src="<?php echo $generique_produit->get("lienImage") ?>" alt="" class="nft"/>
<p><?php echo $generique_produit->get("nomProduit") ?></p>
<div class="market-detail">
    <?php echo $nomCategorie ?>
    <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>">Voir plus</a>


</div>
<button type="submit" name="idProduit" class="button">Ajouter au panier</button>

</div>

<?php } ?>
</main>






