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
                <p class="title">The NFT world at a few clicks</p>
                <p class="title">Find rare digital art and collect NFTs</p>
                <div id="explore_button"><a href="index.php?action=marketPlace&controller=Utilisateur">Explore</a></div>
            </div>
            <canvas>
                ANIMATION THREE JS
            </canvas>
        </article>



        <div id="welcome-numbers">
            <div class="welcome-card">
                <h2>17K +</h2>
                <p>World art</p>
            </div>

            <div class="welcome-card">
                <h2>12K +</h2>
                <p>Exclusive product</p>
            </div>

            <div class="welcome-card">
                <h2>8K +</h2>
                <p>Artist</p>
            </div>
        </div>


    </section>

<form action="index.php?action=search&controller=Produit&" method="post">
    <input name="recherche" id="recherche" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
</form>


    <h2>Popular products</h2>

    <section id="popular">
        <?php
            include "View/produit/aleatoire.php";
        ?>









    </section>

