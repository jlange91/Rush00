<?php session_start();
include ("check_auth.php");
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
	echo "<h1>Barre toi y a rien a voir</h1>";
	echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
	exit();
}

if ($_POST['submit'] === "Delete_user" && $_POST['login'] !== NULL && $_POST['login'] !== "")
{
    if (file_exists("private") === FALSE || file_exists("private/passwd") === FALSE)
    {
        echo "<h1>File not Found</h1>\n";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    }
    else
    {
        $str = file_get_contents("private/passwd");
        $tab = unserialize($str);
        foreach ($tab as $tab_user)
        {
            if ($tab_user['login'] !== $_POST['login'])
            {
                $tab_tmp[] = $tab_user;
            }
        }
        $str = serialize($tab_tmp);
        file_put_contents("private/passwd", $str."\n");
        echo "<h1>User Deleted</h1>\n";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    }
}
else
{
    echo "<h1>Invalid informations</h1>\n";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
}

?>