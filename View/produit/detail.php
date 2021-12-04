<link rel="stylesheet" href="css/detail.css">
<?php
    $idP = rawurldecode($p->get('idProduit'));
    $nomProduit = rawurldecode($p->get('nomProduit'));
    $description = rawurldecode($p->get('description'));
    $nomCategorie = (new ModelCategorie)->getNomCategorie($idP);
    $prix = rawurldecode($p->get('prixProduit'));
    $quantiteProduit = rawurldecode($p->get('quantiteProduit'));
    $lienImage = rawurldecode($p->get('lienImage'));
?>

<section class="glass">
    <h2>Detail</h2>
    <div class="detail-card">
        <img src="<?php echo $lienImage?>"  alt="image du produit">
        <h2><?php echo $nomProduit; ?></h2>
    </div>

    <div>
        <h2>Détails : </h2>
        <p> Description : <?php echo $description ?> </p>
        <p> Categorie : <?php echo $nomCategorie ?> </p>
        <p>  Prix : <?php echo $prix ?>€ </p>
        <p> Quantité en stock : <?php echo $quantiteProduit ?></p>
    </div>
    <button type="submit" name="idProduit" class="button">Ajouter au panier</button>
    <!--                <input type="submit" name="idProduit" value ="Ajouter au panier" style="background-color: #3c1053"/>-->

</section>


<!--echo '<a href="index.php?controller=Produit&&action=delete&&idProduit='. $idP .' "> Supprimer le produit </a><br>';
echo '<a href="index.php?controller=Produit&&action=update&&idProduit='. $idP .' "> Modifier le produit </a>';-->

