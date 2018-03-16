<?php session_start();
?>
<div id="leftbox">

    <div id="info_user">
        <?php if(!check_auth($_SESSION["logged_on_user"])) {?><br/>
        <form id="sign_in" enctype="multipart/form-data" action="sign_in_up.php" method="post">
            <input type="text" name="login" placeholder="Login"/><br/>
            <input type="password" name="passwd" placeholder="Password"/><br/>
            <input type="submit" name="submit" value="Sign In" /> |
            <input type="submit" name="submit" value="Sign Up" />
        </form>

        <?php } else if ($_POST['submit'] == "Change_Password") { echo "<br/>Change Pass<br/><br/>"; ?>
        <form id="change_password" enctype="multipart/form-data" action="modif.php" method="post">
            <input type="text" name="login" placeholder="Login"/><br/>
            <input type="password" name="oldpw" placeholder="Old Password"/><br/>
            <input type="password" name="newpw" placeholder="New Password"/><br/>
            <input type="submit" name="submit" value="Change" /> |
            <input type="submit" name="submit" value="Cancel" />
        </form>
        <br/>

        <?php } else { ?>
        <img id="user_img" src="img/user.svg"><br />
        <?php echo "<br/>Bonjour "; include("whoami.php"); if (check_auth($_SESSION['logged_on_user']) === 2){echo "<br/>Admin";?><br /><br/>
        <form id="admin_atr" enctype="multipart/form-data" action="admin_articles.php" method="post">
            <input type="submit" name="submit" value="admin_art" />
            <input type="submit" name="submit" value="admin_usr" />
            <input type="submit" name="submit" value="admin_ord" />
        </form>
        <?php } else { echo "<br/><br/>"; } ?>
        <a href="logout.php"><input type="submit" value="Logout" /></a>
        <form enctype="multipart/form-data" action="index.php" method="post">
            <input type="submit" name="submit" value="Change_Password" />
        </form>
        <br/>
        <?php } ?>

        <div id="new_articles">
            <?php
            echo "News Articles<br/><br/>";
            $mysqli = mysqli_connect("localhost", "root", "root", "site");
            $rep = mysqli_query($mysqli, 'SELECT * FROM articles');
            $i = 0;
            while ($donnees = mysqli_fetch_assoc($rep))
                $i++;
            mysqli_free_result($rep);
            if ($mysqli)
                mysqli_close($mysqli);
            $mysqli = mysqli_connect("localhost", "root", "root", "site");
            $rep = mysqli_query($mysqli, 'SELECT * FROM articles');
            $o = 1;
            while ($donnees = mysqli_fetch_assoc($rep))
            {
                if ($o >= ($i - 1))
                {
                    echo "<img class=img_last_art width=100 heigth=100% src=".$donnees['img_path']."><br/>";
                    echo $donnees['price']." €<br/><br/>";
                }
                $o++;
            }
            mysqli_free_result($rep);
            if ($mysqli)
                mysqli_close($mysqli);
            ?>
        </div>
    </div>
</div>












