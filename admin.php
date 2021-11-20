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



<?php
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("View", $controller, "$view.php"));
require $filepath;
?>