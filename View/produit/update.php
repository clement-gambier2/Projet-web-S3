<?php
    $idProduit = $_GET["idProduit"];

    if($idProduit != ""){
        require_once File::build_path(Array("Model", "ModelProduit.php"));
        $produit = ModelProduit::select($idProduit);

        $nom = htmlspecialchars($produit->get('nomProduit'));
        $description = htmlspecialchars($produit->get('descriptionProduit'));
        $categorie = htmlspecialchars($produit->get('idCategorie'));
        $prix = htmlspecialchars($produit->get('prixProduit'));
        $quantite = htmlspecialchars($produit->get('quantiteProduit'));
    }
?>


<form>
    <fieldset>
        <legend>Création d'un produit</legend>

        <input type="hidden" name='action' value='created'>
        <input type="hidden" name='controller' value='produit'>

        <!-- Faire en sorte qu'il s'autoincrémente au lieu de le remplir à la main-->
        <p>
            <label for="idProduit">Id du Produit</label> :
            <input type="text" placeholder="5" name="idProduit" id="idProduit" value="<?php echo $idProduit; ?>" readonly>
        </p>
        

        <p>
            <label for="nomProduit">Nom du produit :</label>
            <input type="text" placeholder="Nom du produit" name="nomProduit" id="nomProduit" value="<?php echo $nom; ?>" required/>
        </p>

        <p>
            <label for="descriptionProduit">Description du produit :</label>
            <input type="text" placeholder="Un produit vraiment interessant à acheter" name="descriptionProduit" id="descriptionProduit" value="<?php echo $description; ?>"/>
        </p>

        <p>
            <label for="idCategorie">ID de la catégorie :</label>
            <input type="number" placeholder="1" name="idCategorie" id="idCategorie" value="<?php echo $categorie; ?>" required/>
        </p>

        <p>
            <label for="prixProduit">Prix du produit :</label>
            <input type="number" placeholder="15" name="prixProduit" id="prixProduit"  value="<?php echo $prix; ?>" required/>
        </p>

        <p>
            <label for="quantiteProduit">Quantite du produit :</label>
            <input type="number" placeholder="2" name="quantiteProduit" id="quantiteProduit" value="<?php echo $quantite; ?>" required/>
        </p>


        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</form>