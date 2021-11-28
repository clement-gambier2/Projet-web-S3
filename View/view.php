<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
</head>


<nav>
    <a href="index.php"><h1>NFT Factory</h1></a>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="index.php?action=marketPlace&controller=Utilisateur">Boutique</a></li>
        <li><a href="#">Createurs</a></li>
        <?php
        if (isset($_SESSION['login'])) {

            echo'<li><a href="index.php?action=afficherPanier&controller=Utilisateur"><img id = "panier" src="ressources/panier.png" alt=""></a></li>';

            echo '<li><a href="index.php?action=update&controller=Utilisateur&idUtilisateur='. ModelUtilisateur::getUtilisateurByPseudo($_SESSION['login']) .'&pseudo='. $_SESSION['login'] .'">' . $_SESSION['login'] . '</a></li>';
            echo '<li><a href="index.php?action=deconnect&controller=Utilisateur">Déconnexion</a></li>';

            if ($_SESSION['admin'] == 1) {
                echo '<li><a href="index.php?action=afficher&controller=Admin">Panneau Admin</a></li>';
            }
        }
        else {
            echo '<li><a href="index.php?action=connect&controller=Utilisateur">Connexion</a></li>';
        }
        ?>


    </ul>
</nav>

<body>




<?php
    // Si $controleur='voiture' et $view='list',
    // alors $filepath="/chemin_du_site/view/voiture/list.php"
    $filepath = File::build_path(array("View", $controller, "$view.php"));
    require $filepath;
?>


</body>

<footer>
    <p>Made by Sylvain Batte, Clément Gambier and Thomas Mauran</p>
    <p>2021</p>
</footer>

</html>