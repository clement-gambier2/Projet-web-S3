<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
</head>

<body>

<a href="index.php?action=connect&controller=Utilisateur">Se connecter</a>
<a href="index.php?action=deconnect&controller=Utilisateur">Déconnexion</a>

<nav class="menu" style="border: 2px solid green;padding-left:2em;">

    <h2 style="color:blue">Utilisateurs</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Utilisateur">Tout les utilisateurs</a></li>
        <li><a href="index.php?action=create&controller=Utilisateur">Créer un utilisateur</a></li>
    </ul>


    <h2 style="color:green">Produits</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Produit">Tout les produits</a></li>
        <li><a href="index.php?action=create&controller=Produit">Créer un produit</a></li>
    </ul>
  
    <h2 style="color:orange">Commandes</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Commande">Toutes les commandes</a></li>
        <li><a href="index.php?action=readAll&controller=Commande">Créer une commande</a></li>
    </ul>

</nav>

<?php
    // Si $controleur='voiture' et $view='list',
    // alors $filepath="/chemin_du_site/view/voiture/list.php"
    $filepath = File::build_path(array("View", $controller, "$view.php"));
    require $filepath;

    if (isset($_SESSION['login'])) {
        echo "Utilisateur connecté : " . $_SESSION['login'];
    } else {
        echo "Pas d'utilisateur connecté";
    }
?>

<p style="border: 1px solid black;text-align:right;padding-right:1em;"> NFT factory </p>
</body>

</html>