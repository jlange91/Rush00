<?php session_start();
include ("check_auth.php");
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
    echo "<h1>Barre toi y a rien a voir</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit();
}

if (isset($_GET['del']))
{
    if (is_numeric($_GET['del']))
    {
        $mysqli = mysqli_connect("localhost", "root", "root", "site");
        if ($rep = mysqli_query($mysqli, 'SELECT * FROM articles'))
        {
            while ($donnees = mysqli_fetch_assoc($rep))
            {
                if ($donnees['id'] === $_GET['del'])
                    $src = $donnees['img_path'];
            }
            mysqli_free_result($rep);
        }
        else
        {
            echo("<h1>Error request</h1>");
            echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
            exit;
        }
        if (!mysqli_query($mysqli, "DELETE FROM `articles` WHERE id = " . $_GET['del']))
            echo "<h1>Error request</h1>";
        if (unlink($src) == FALSE)
            echo "<h1>Error delete image</h1>\n";
        else
            echo "<h1>Success delete</h1>\n";
    }
    else
        echo "<h1>Error value is not numeric value</h1>";
    if ($mysqli)
        mysqli_close($mysqli);        
}
echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
?>