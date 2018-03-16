<?php session_start();
include ("check_auth.php");
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
    echo "<h1>Barre toi y a rien a voir</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit();
}

if (isset($_POST['id']))
{
    if (is_numeric($_POST['id']))
    {
        $mysqli = mysqli_connect("localhost", "root", "root", "site");
        if ($rep = mysqli_query($mysqli, 'SELECT * FROM articles'))
        {
            while ($donnees = mysqli_fetch_assoc($rep))
            {
                if ($donnees['id'] === $_POST['id'])
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
        if (!mysqli_query($mysqli, "DELETE FROM `articles` WHERE id = ".$_POST['id']))
            echo "<h1>Error request</h1>";
        if (unlink($src) == FALSE)
            echo "<h1>Error delete image</h1>\n";
    }
    else
        echo "<h1>Error value is not numeric value</h1>";
    if ($mysqli)
        mysqli_close($mysqli);        
}

/************************************************************
 * Definition des constantes / tableaux et variables
 *************************************************************/
 
$msg = '';
$path = "img/articles/";
$extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
$maxwidth = 3200;
$maxheight = 3200;

/************************************************************
 * Creation du repertoire cible si inexistant
 *************************************************************/
if( !is_dir($path) ) {
  if( !mkdir($path, 0755) ) {
    echo '<h1>Error: repertory cant be create check yours rights !</h1>';
    echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
    exit;
  }
}

/************************************************************
 * Check valeurs de post reçues
 *************************************************************/

if (!isset($_POST["categ"]))
{
    echo '<h1>Error: no categories set !</h1>';
    echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
    exit;
}
if (!isset($_POST["price"]))
{
    echo '<h1>Error: no price set !</h1>';
    echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
    exit;
}
if (!is_numeric($_POST["price"]) || preg_match("/e/", $_POST["price"]))
{
    echo '<h1>Error: price is not numeric !</h1>';
    echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
    exit;
}
if (!is_numeric($_POST["stock"]) || preg_match("/e/", $_POST["price"]))
{
    echo '<h1>Error: stock is not numeric !</h1>';
    echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
    exit;
}
$ret = preg_split("/([0-9]{1,2};)*/", $_POST["categ"]);
foreach ($ret as $value)
{
    if ($value != "")
    {
        echo '<h1>Error: bad categories string !</h1>';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
        exit;
    }
}

/************************************************************
 * Script d'upload
 *************************************************************/

if ($_FILES['fichier']['error'] > 0)
    $msg = "Error :" . $_FILES['fichier']['error'];
else if (!$_POST['categ'])
    $msg = "<h1>Error : No categories.</h1>";
else if (!$_POST['price'])
    $msg = "<h1>Error : No price.</h1>";
else
{
    $extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
    if (!in_array($extension_upload,$extensions_valides) )
        $msg = "<h1>Invalid extension (jpg, jpeg and png only)</h1>";
    else
    {
        $image_sizes = getimagesize($_FILES['fichier']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
            $msg = "<h1>Image trop grande</h1>";
        else
        {
            $i = 0;
            $mysqli = mysqli_connect("localhost", "root", "root", "site");
            if ($rep = mysqli_query($mysqli, 'SELECT * FROM articles')){
                while ($donnees = mysqli_fetch_assoc($rep))
                {
                    $i = $donnees['id'];
                }
                mysqli_free_result($rep);
            }
            else
            {
                echo("<h1>Error request</h1>");
                echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
                exit;
            }
            $i++;	
            $nom = $path . $i . "." . $extension_upload;
            $result = move_uploaded_file($_FILES['fichier']['tmp_name'], $nom);
            if ($result)
            {
                $test = "test";
                $stmt = mysqli_prepare($mysqli, 'INSERT INTO `articles`(`id`, `categ`, `img_path`, `price`, `stock`) VALUES (?, ?, ?, ?, ?)');
                mysqli_stmt_bind_param($stmt, "issii", $i, $_POST["categ"], $nom, $_POST["price"], $_POST["stock"]);
                $rep = mysqli_stmt_execute($stmt);
                if ($rep)
                    $msg = "<h1>Success Modification</h1>";
                else
                    $msg = "<h1>" . mysqli_connect_error() . "</h1>";
            }
            else
                $msg = "<h1>Unknow error</h1>";
            if ($mysqli)
                mysqli_close($mysqli);
        }
    }
}

echo $msg;

echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_articles.php\"/>";
?>