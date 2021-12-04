<?php
/*if ($resulat == false) {
    echo "Pas de résulat pour ce que vous recherchez.";
}
else{
    echo "Y a un truc";
}
*/?>

<?php
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
    <button type="submit" name="idProduit" class="button">Ajouter au panier</button>
    <!--                <input type="submit" name="idProduit" value ="Ajouter au panier" style="background-color: #3c1053"/>-->
</div>


