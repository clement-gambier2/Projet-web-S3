<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
</head>

<body>

<nav class="menu" style="border: 2px solid green;padding-left:2em;">
    
    <h2 style="color:green">Utilisateurs</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Utilisateur">Tout les utilisateurs</a></li>
        <li><a href="index.php?action=create&controller=Utilisateur">Créer un utilisateur</a></li>
    </ul>


    <h2 style="color:green">Commandes</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Commande">Toutes les commandes</a></li>
    </ul>

    <h2 style="color:green">Produits</h2>
    <ul>
        <li><a href="index.php?action=readAll&controller=Produit">Tout les produits</a></li>
    </ul>

</nav>

<?php
    // Si $controleur='voiture' et $view='list',
    // alors $filepath="/chemin_du_site/view/voiture/list.php"
    $filepath = File::build_path(array("View", $controller, "$view.php"));
    require $filepath;
?>

<p style="border: 1px solid black;text-align:right;padding-right:1em;"> NFT factory </p>
</body>

</html>