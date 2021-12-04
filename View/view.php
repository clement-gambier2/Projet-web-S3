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
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php?action=marketPlace&controller=Utilisateur">Marketplace</a></li>
        <li><a href="#">Creators</a></li>
        <?php
        if (isset($_SESSION['login'])) {

            echo'<li><a href="index.php?action=afficherPanier&controller=Utilisateur"><img id = "panier_icon" src="ressources/panier.png" alt=""></a></li>';

            if ($_SESSION['admin'] == 1) {
                echo $_SESSION['login'];
                echo '<li><a href="index.php?action=deconnect&controller=Utilisateur">Log out</a></li>';
                echo '<li><a href="index.php?action=afficher&controller=Admin">Administrator</a></li>';
            }
            else {
                echo $_SESSION['login'];
                echo '<li><a href="index.php?action=deconnect&controller=Utilisateur">Log out</a></li>';
            }
        }
        else {
            echo '<li><a href="index.php?action=connect&controller=Utilisateur">Log in</a></li>';
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