<?php 
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
    echo "<h1>Barre toi y a rien a voir</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit();
}?>

<div id="hearth">
    <div id="hearth_admin">
        <div id="article_admin">
            <div class="gallery_admin">
                <div class="desc_admin">
                    <form enctype="multipart/form-data" action="user_to_admin.php" method="post">
                        <input type="text" name="login" placeholder="Login"/><br/>
                        <input type="submit" name="submit" value="Up_User" /> |
                        <input type="submit" name="submit" value="Down_User" />
                    </form>

                    <form enctype="multipart/form-data" action="delete_user.php" method="post">
                        <input type="text" name="login" placeholder="Login"/><br/>
                        <input type="submit" name="submit" value="Delete_user" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>