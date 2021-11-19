<form>
    <fieldset>
        <legend>Création d'un produit</legend>

        <input type="hidden" name='action' value='created'>
        <input type="hidden" name='controller' value='produit'>

        <!-- Faire en sorte qu'il s'autoincrémente au lieu de le remplir à la main-->
        <p>
            <label for="idProduit">Id du Produit</label> :
            <input type="text" placeholder="5" name="idProduit" id="idProduit" value="">
        </p>
        

        <p>
            <label for="nomProduit">Nom du produit :</label>
            <input type="text" placeholder="Nom du produit" name="nomProduit" id="nomProduit" required/>
        </p>

        <p>
            <label for="descriptionProduit">Description du produit :</label>
            <input type="text" placeholder="Un produit vraiment interessant à acheter" name="descriptionProduit" id="descriptionProduit"/>
        </p>

        <p>
            <label for="idCategorie">ID de la catégorie :</label>
            <input type="number" placeholder="1" name="idCategorie" id="idCategorie" required/>
        </p>

        <p>
            <label for="prixProduit">Prix du produit :</label>
            <input type="number" placeholder="15" name="prixProduit" id="prixProduit"  required/>
        </p>

        <p>
            <label for="quantiteProduit">Quantite du produit :</label>
            <input type="number" placeholder="2" name="quantiteProduit" id="quantiteProduit" required/>
        </p>


        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>