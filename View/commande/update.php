
<form action="index.php" method="get">

    <h1>Creation de la commande</h1>
    <h2>Selectionnez l'utilisateur</h2>
    <select name="idUser">
        <?php
        if($action == "updated"){
            $pseudo = $idUtilisateur;
            echo "<option value='$pseudo'>$pseudo</option>";
        }
        else{
            foreach ($tab_utilisateur as $utilisateur) {
            $pseudo = $utilisateur->getIdUtilisateur();
            echo "<option value='$pseudo'>$pseudo</option>";
        }

        } ?>
    </select>
    <h2>Selectionnez les produits</h2>
    <?php

        // Cas de l'update

        if(isset($tab_produitChecked)){
            foreach($tab_produitChecked as $p){
                $prodName = $p->get('nomProduit');
                $prodId = $p->get('idProduit');

                if(in_array($p, $tab_prod)){
                    $key = array_search($p, $tab_prod);
                    unset($tab_prod[$key]);
                    echo "<input checked type='checkbox' name='produit[]' value='" . rawurlencode($prodId) . "'>$prodName</input><br>";
                }
            }
        }

        foreach ($tab_prod as $prod){
            $prodName = $prod->get('nomProduit');
            $prodId = $prod->get('idProduit');

            // Cas du create
            echo "<input type='checkbox' name='produit[]' value='" . rawurlencode($prodId) . "'>$prodName</input><br>";

        }
    ?>

    <?php
        if($action == "updated"){
            echo "<input hidden name='idCommande' value=" . $idCommande . " >";
        }
    ?>
    <input hidden name="action" value=<?php echo $action ?>>
    <input hidden name="controller" value="Commande" >

    <input type="submit" value="Submit">
</form>
