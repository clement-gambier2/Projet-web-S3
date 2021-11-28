<?php

class Panier
{
    public static function ajouterAuPanier($idProduit){
        if(empty($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }

        array_push($_SESSION['cart'], $idProduit);

        echo "produit ajouté au panier !";

    }
}