<?php


    if(isset($idProduit)){
        require_once File::build_path(Array("Model", "ModelProduit.php"));
        $produit = ModelProduit::select($idProduit);

        $nom = htmlspecialchars($produit->get('nomProduit'));
        $description = htmlspecialchars($produit->get('descriptionProduit'));
        $categorie = htmlspecialchars($produit->get('idCategorie'));
        $prix = htmlspecialchars($produit->get('prixProduit'));
        $quantite = htmlspecialchars($produit->get('quantiteProduit'));
        $lienImage = htmlspecialchars($produit->get('lienImage'));

    }
    else{
        $idProduit =
        $nom = "";
        $description = "";
        $categorie = "";
        $prix = "";
        $quantite = "";
        $lienImage = "";

    }
?>

<link rel="stylesheet" href="css/form.css">
<form method="post" class="glass2" action="index.php?action=<?php echo $action ?>&controller=Produit">
    <fieldset>
        <?php
        if($action == "created"){
            echo "<h1>Creation d'un produit</h1>";

        }
        else{
            echo "<h1>Modification d'un produit</h1>";

        }
        ?>
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
            <select name="idCategorie">
                <?php


                    foreach ($tab_categorie as $cat) {

                        $idCategorie = $cat->get('idCategorie');
                        $categorie = $cat->get('nomCategorie');

                        if($categorie == $idCategorie)
                        {
                            echo "<option selected value='$idCategorie'>$categorie</option>";
                        }
                        else{

                            echo "<option value='$idCategorie'>$categorie</option>";
                        }


                } ?>
            </select>
        </p>

        <p>
            <label for="prixProduit">Prix du produit :</label>
            <input type="number" placeholder="15" name="prixProduit" id="prixProduit"  value="<?php echo $prix; ?>" required/>
        </p>


        <p>
            <label for="lienImage">Image du produit :</label>
            <input type="text" placeholder="url de l'image" name="lienImage" id="lienImage" value="<?php echo $lienImage; ?>" required/>
        </p>


        <div id="send">
            <p>
                <input type="submit" value="Envoyer" id="submit" />
            </p>
        </div>
    </fieldset>
</form>
</form>