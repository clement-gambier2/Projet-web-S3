<?php
if($p == false){
    echo "pas de résultat";
}
else{
    $idProduit = $p->get("idProduit");
    $idCategorie = $p->get("idCategorie");
    $nomCategorie = (new ModelCategorie)->getNomCategorie($idCategorie);
?>
<div class="card">
    <img src="<?php echo $p->get("lienImage") ?>" alt="" class="nft"/>
    <p><?php echo $p->get("nomProduit") ?></p>
    <div class="market-detail">
        <?php echo $nomCategorie ?>
        <a href="index.php?action=read&controller=Produit&idProduit=<?php echo $idProduit ?>">Voir plus</a>
    </div>
    <button type="submit" name="idProduit" class="button">Ajouter au panier</button>
</div>

<?php } ?>
