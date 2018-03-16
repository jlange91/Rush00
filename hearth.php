<div id="hearth">

    <?php include("check_cat.php"); ?>

    <?php $mysqli = mysqli_connect("localhost", "root", "root", "site");
    $rep = mysqli_query($mysqli, 'SELECT * FROM articles');
    while ($donnees = mysqli_fetch_assoc($rep))
    {
        if (check_cat($_GET["cat"], $donnees["categ"]) == TRUE && $donnees["stock"] > 0)
        {
            echo "
<div class=\"article\">
<div class=\"gallery\">
<img src=".$donnees['img_path']." alt=\"test\" width=\"300\" height=\"200\" />
<div class=\"desc\">
<div id=\"price\">".$donnees['price']." €</div>
<div id=\"stock\">".$donnees['stock']." en stock</div>
<form enctype=\"multipart/form-data\" action=\"cart.php\" method=\"post\">
<select id=\"selector\" name=\"nb\">";
$i = 1;
while ($i <= $donnees["stock"] && $donnees["stock"] > 0)
{
    echo "<option>" . $i . "</options>";
    $i++;
}echo "
</select> <br/>
<input type=\"hidden\" name=\"id\" value=".$donnees['id'].">
<input id=\"Add_Button\" type=\"submit\" name=\"submit\" value=\"Ajouter\" />
</form>
</div>
</div>
</div>";
        }
    }
    mysqli_free_result($rep);
    if ($mysqli)
        mysqli_close($mysqli);
    ?>
    <div class=\"clearfix\"></div>

</div>
