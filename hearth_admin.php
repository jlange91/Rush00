<div id="hearth">

    <?php include("check_cat.php"); ?>

    <?php $mysqli = mysqli_connect("localhost", "root", "root", "site");
    $rep = mysqli_query($mysqli, 'SELECT * FROM articles');
    while ($donnees = mysqli_fetch_assoc($rep))
    {
        //        if (check_cat($_GET["cat"], $donnees["categ"]) == TRUE)
        //        {
        echo "
<div class=\"article_admin\">
<div class=\"gallery_admin\">
<a target=\"_blank\" href=".$donnees['img_path'].">
<img src=".$donnees['img_path']." alt=\"test\" width=\"300\" height=\"200\">
</a>
<div class=\"desc_admiin\">
<div id=\"id\">Id: ".$donnees['id']."</div>
<div id=\"categ\">Catégories: ".$donnees['categ']."</div>
<div id=\"price\">".$donnees['price']." €</div>
<div id=\"stock\">".$donnees['stock']." en stock</div>
</div>
</div>
</div>";
        //        }
    }
    mysqli_free_result($rep);
    if ($mysqli)
        mysqli_close($mysqli);
    ?>
    <div class=\"clearfix\"></div>

    <div id="hearth_admin">
    <div id="article_admin">
    <div class="gallery_admin">
    <div class="desc_admin">
    <!-- Formulaire upload fichier -->
    <form enctype="multipart/form-data" action="add_articles.php" method="post">
        <fieldset>
            <legend>Add article</legend>
            <label for="fichier_a_uploader" title="Search file !"></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="file" />
            <p>Categories: </p>
            <input name="categ" placeholder="Exemple: 1;2;[...];" /><br/>
            <p>Price</p>
            <input name="price" placeholder="Exemple : 100" />
            <p>Stock</p>
            <input name="stock" placeholder="Exemple : 100" />
            <input type="submit" name="submit" value="Upload" />
        </fieldset>
    </form>
    <!-- Formulaire delete fichier -->
    <form enctype="multipart/form-data" action="remove_articles.php" method="get">
        <fieldset>
            <legend>Delete article</legend>
            Identifiant à supprimer: <input type="text" name="del"/>
            <input type="submit"/>
        </fieldset>
    </form>
    <!--      Formulaire modif article-->
    <form enctype="multipart/form-data" action="modif_article.php" method="post">
        <fieldset>
            <legend>Modif article</legend>
            <p>Id: </p>
            <input name="id" placeholder="Id" /><br/>
            <label for="fichier_a_uploader" title="Search file !"></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="file" />
            <p>Categories: </p>
            <input name="categ" placeholder="Exemple: 1;2;[...];" /><br/>
            <p>Price</p>
            <input name="price" placeholder="Exemple : 100" />
            <p>Stock</p>
            <input name="stock" placeholder="Exemple : 100" />
            <input type="submit" name="submit" value="Modif" />
        </fieldset>
    </form>
        </div>
        </div>
        </div>
    </div>

</div>