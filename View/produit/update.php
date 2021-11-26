<?php


    if(isset($idProduit)){
        require_once File::build_path(Array("Model", "ModelProduit.php"));
        $produit = ModelProduit::select($idProduit);

        $nom = htmlspecialchars($produit->get('nomProduit'));
        $description = htmlspecialchars($produit->get('descriptionProduit'));
        $categorie = htmlspecialchars($produit->get('idCategorie'));
        $prix = htmlspecialchars($produit->get('prixProduit'));
        $quantite = htmlspecialchars($produit->get('quantiteProduit'));
    }
    else{
        $idProduit =
        $nom = "";
        $description = "";
        $categorie = "";
        $prix = "";
        $quantite = "";
    }
?>

<link rel="stylesheet" href="css/form.css">
<form method="post" class="glass2" action="/p_web_s3/index.php?action=<?php echo ($action == "create") ? 'created' : 'updated' ?>&controller=Produit">
    <fieldset>
        <h2>Création d'un produit</h2>
        <input type="hidden" name='action' value='<?php echo $action; ?>' />
        <input type="hidden" name='idProduit' value='<?php echo $idProduit; ?>' />
        <input type="hidden" name='controller' value='produit'>



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


        <div id="send">
            <p>
                <input type="submit" value="Envoyer" id="submit" />
            </p>
        </div>
    </fieldset>
</form>
</form>