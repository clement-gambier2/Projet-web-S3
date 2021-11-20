<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'Lib/File.php';
require_once File::build_path(array("Controller", "routeur.php"));
?>
    <link rel="stylesheet" href="css/home.css">
    <section id="welcome">

        <article id="welcome-header">
            <div>
                <p class="title">The NFT world at a few clicks</p>
                <p class="title">Find rare digital art and collect NFTs</p>
                <div class="button">Explore</div>
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

    <h2>Popular products</h2>

    <section id="popular">


        <div class="card">
            <img src="/ressources/NFT/drawing/face.jpeg" alt="" class="nft"/>
            <p>Drawing</p>
            <div class="picture-profil">
                <img src="/ressources/profile.png" class="profil"">
                <p>Jungle</p>
            </div>
            <div class="button">Add to cart</div>
        </div>

        <div class="card">
            <img src="/ressources/NFT/drawing/girl_guy.jpg.webp" alt="" class="nft"/>
            <p>Drawing</p>
            <div class="picture-profil">
                <img src="/ressources/profile.png" class="profil"">
                <p>Jungle</p>
            </div>
            <div class="button">Add to cart</div>
        </div>

        <div class="card">
            <img src="p_web_s3/ressources/NFT/drawing/road.jpeg" alt="" class="nft"/>
            <p>Drawing</p>
            <div class="picture-profil">
                <img src="/ressources/profile.png" class="profil"">
                <p>Jungle</p>
            </div>
            <div class="button">Add to cart</div>
        </div>

        <div class="card">
            <img src="/ressources/NFT/drawing/squid.png.webp" alt="" class="nft"/>
            <p>Drawing</p>
            <div class="picture-profil">
                <img src="/ressources/profile.png" class="profil"">
                <p>Jungle</p>
            </div>
            <div class="button">Add to cart</div>
        </div>

        <div class="card">
            <img src="/ressources/NFT/drawing/woman.jpeg" alt="" class="nft"/>
            <p>Drawing</p>
            <div class="picture-profil">
                <img src="/ressources/profile.png" class="profil"">
                <p>Jungle</p>
            </div>
            <div class="button">Add to cart</div>
        </div>

    </section>

