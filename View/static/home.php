<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'Lib/File.php';
require_once File::build_path(array("Controller", "routeur.php"));
?>
    <link rel="stylesheet" href="css/home.css">
    <section id="welcome" class="glass">

        <article id="welcome-header">
            <div>
                <p class="title">Le monde des NFT en quelques clics</p>
                <p class="title">Trouvez des œuvres d'art numériques rares et collectionnez les NFT</p>
                <div id="explore_button"><a href="index.php?action=marketPlace&controller=Utilisateur">Explorer</a></div>
            </div>
            <img src="ressources/rocket-dynamic-color.png" id="rocket">
        </article>



        <div id="welcome-numbers">
            <div class="welcome-card">
                <h2>17K +</h2>
                <p>Oeuvres d'art</p>
            </div>

            <div class="welcome-card">
                <h2>12K +</h2>
                <p>Produits exclusifs</p>
            </div>

            <div class="welcome-card">
                <h2>8K +</h2>
                <p>Artistes</p>
            </div>
        </div>


    </section>

<form action="index.php?action=search&controller=Produit&" method="post">
    <input name="recherche" id="search_bar" type="text" placeholder="Tapez un nom de produit">
    <input class="button" type="submit" value="Rechercher">
</form>


    <h2>Produits populaires</h2>

    <section id="popular">
        <?php
            include "View/produit/aleatoire.php";
        ?>
    </section>

