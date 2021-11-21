

<form action="index.php" method="get">

    <h1>Creation de la commande</h1>
    <h2>Selectionnez l'utilisateur</h2>
    <select name="idUser">
        <?php
            foreach ($tab_utilisateur as $utilisateur) {
                $pseudo = $utilisateur->getIdUtilisateur();
            echo "<option value='$pseudo'>$pseudo</option>";
        } ?>
    </select>
    <h2>Selectionnez les produits</h2>
    <?php
        foreach ($tab_prod as $prod){
            $prodName = $prod->get('nomProduit');
            $prodId = $prod->get('idProduit');
            echo "<input type='checkbox' name='produit[]' value='" . rawurlencode($prodId) . "'>$prodName</input><br>";
        }
    ?>


    <input hidden name="action" value="created" >
    <input hidden name="controller" value="Commande" >

    <input type="submit" value="Submit">
</form>

