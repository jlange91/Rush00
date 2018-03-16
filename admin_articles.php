<?php session_start();
include ("check_auth.php");
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
    echo "<h1>Barre toi y a rien a voir</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit();
}?>

<HTML>
    <HEAD>
        <TITLE>Order</TITLE>
        <meta charset="UTF-8">
        <LINK href="user_bar.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="nav.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="hearth.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="index.css" rel="stylesheet" type="text/css"></LINK>
    </HEAD>
    <BODY>
        <?php
        if( !empty($msg) ) 
        {
            echo '<div id="adm_">',"\n";
            echo "\t\t<strong>", htmlspecialchars($msg) ,"</strong>\n";
            echo "\t</p>\n\n";
        }
        ?>

        <?php include("nav.php"); ?>

        <?php include("user_bar.php"); ?>

        <?php
        if ($_POST['submit'] == "admin_art")
            include ("hearth_admin.php"); 
        if ($_POST['submit'] == "admin_usr")
            include ("hearth_users.php");
        if ($_POST['submit'] == "admin_ord")
            include ("hearth_admin_orders.php");
        ?>

        <footer>
            <div>
                (Powerded by Github <img src="http://graycoder.ir/pics/social/git.png" /><span>) Site by ajehanno, jlange, zzeller.</span>
            </div>
        </footer>
    </BODY>
</HTML>