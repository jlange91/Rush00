<?php

if ($_POST['submit'] === "Change" && $_POST['login'] !== NULL && $_POST['oldpw'] !== NULL && $_POST['newpw'] !== NULL && $_POST['login'] !== "" && $_POST['oldpw'] !== "" && $_POST['newpw'] !== "")
{
    if (file_exists("private") === FALSE || file_exists("private/passwd") === FALSE)
    {
        echo "<h1>File not Found</h1>\n";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    }
    else
    {
        $v = 0;
        $str = file_get_contents("private/passwd");
        $tab = unserialize($str);
        foreach ($tab as $tab_user)
        {
            if ($tab_user['login'] == $_POST['login'])
            {
                $v = 1;
                if ($tab_user['passwd'] !== hash("whirlpool", $_POST['oldpw']))
                {
                    echo "<h1>Passeword invalid</h1>\n";
                    echo "<meta http-equiv=\"refresh\" content=\"1;url=modif.php\"/>";
                    return;
                }
                else
                {
                    $tab_user['passwd'] = hash("whirlpool", $_POST['newpw']);
                }
            }
            $tab_tmp[] = $tab_user;
        }
        if ($v === 0)
        {
            echo "<h1>Login invalid</h1>\n";
            echo "<meta http-equiv=\"refresh\" content=\"1;url=modif.php\"/>";
            return;
        }
        $str = serialize($tab_tmp);
        file_put_contents("private/passwd", $str."\n");
        echo "<h1>Passeword modified</h1>\n";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    }
}
else if ($_POST['submit'] === 'Cancel')
{
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
}
else
{
    echo "<h1>Invalid informations</h1>\n";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
}

?>