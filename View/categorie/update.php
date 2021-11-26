<?php


if(isset($idCategorie)){
    require_once File::build_path(Array("Model", "ModelProduit.php"));
    $categorie = ModelCategorie::select($idCategorie);

    $nomCategorie = htmlspecialchars($categorie->get('nomCategorie'));
    $idCategorie = htmlspecialchars($categorie->get('idCategorie'));


}
else{
    $idCategorie = "";
    $nomCategorie = "";


}
?>

<link rel="stylesheet" href="css/form.css">
<form method="post" class="glass2" action=" index.php?action=<?php echo $action ?>&controller=Categorie">
    <fieldset>
        <h2>Création d'une catégorie</h2>
        <input type="hidden" name='action' value='<?php echo $action; ?>' />
        <input type="hidden" name='idCategorie' value='<?php echo $_GET['idCategorie']; ?>' />
        <input type="hidden" name='controller' value='produit'>

        <p>
            <?php
                if($action == "updated"){?>

            <label for="idCategorie">ID de la catégorie :</label>
            <p><?php echo $_GET['idCategorie']?></p>


            <?php }?>

        </p>


        <p>
            <label for="nomCategorie">Nom de la catégorie :</label>
            <input type="text" placeholder="nom de la catégorie" name="nomCategorie" id="nomCategorie" value="<?php echo $nomCategorie; ?>" required/>
        </p>


        <div id="send">
            <p>
                <input type="submit" value="Envoyer" id="submit" />
            </p>
        </div>
    </fieldset>
</form>
</form>