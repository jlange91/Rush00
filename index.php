<?php session_start();
include("check_auth.php");
?>

<HTML>
    <HEAD>
        <TITLE>Rush00</TITLE>
        <meta charset="UTF-8">
        <LINK href="index.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="nav.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="hearth.css" rel="stylesheet" type="text/css"></LINK>
        <LINK href="user_bar.css" rel="stylesheet" type="text/css"></LINK>
    </HEAD>
    <BODY>
        <?php include("nav.php"); ?>

        <?php include("user_bar.php"); ?>

        <?php include("hearth.php"); ?>

        <footer>
            <div>
                (Powerded by Github <img src="http://graycoder.ir/pics/social/git.png" /><span>) Site by ajehanno, jlange, zzeller.</span>
            </div>
        </footer>
    </BODY>
</HTML>
