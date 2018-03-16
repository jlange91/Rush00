<?php session_start();

include("rand.php");

$filename = "private/passwd";
$pathname = "private/";


if (!ctype_alnum($_POST["login"]) || !ctype_alnum($_POST["passwd"]))
{
    echo "<h1>Login and password can only contain alphanumeric characters.\n</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit;
}

if ($_POST["submit"] == 'Sign Up')
{
    foreach ($_POST as $key => $value)
    {
        if ($key == "login")
            $login = $value;
        else if ($key == "passwd")
            $passwd = $value;
    }
    if ($login == "" || $passwd == "")
    {
        echo "<h1>Bad login or passwd.\n</h1>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
        exit;
    }

    $account["login"] = $login;
    $account["passwd"] = hash("whirlpool", $passwd);
    $account["token"] = "";
    $account["status"] = 1;

    if (!file_exists($pathname))
        mkdir($pathname);

    if (file_exists($filename))
        $data = unserialize(file_get_contents($filename));
    else
        $data = array();
    if ($data !== NULL && $data !== FALSE    && isset($data))
    {
        foreach ($data as $value)
        {
            if ($value["login"] === $login)
            {
                echo "<h1>Login already use.\n</h1>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
                exit;
            }
        }
    }
    $data[] = $account;
    file_put_contents($filename, serialize($data));
    echo "<h1>OK\n</h1>";
}
else if ($_POST["submit"] == 'Sign In')
{
    include("auth.php");

    foreach ($_POST as $key => $value)
    {
        if ($key == "login")
            $login = $value;
        else if ($key == "passwd")
            $passwd = $value;
    }
    if ($login == "" || $passwd == "" || !auth($login, $passwd))
    {
        $_SESSION["logged_on_user"] = "";
        $_SESSION["token"] = "";
        echo "<h1>Bad login or passwd.\n</h1>";
    }
    else
    {
        $_SESSION["logged_on_user"] = $login;
        if (!file_exists($pathname))
            mkdir($pathname);
        if (file_exists($filename))
            $data = unserialize(file_get_contents($filename));
        foreach ($data as $key => $value)
        {
            if ($value["login"] === $login)
            {
                $data[$key]["token"] = random(30);
                $_SESSION["token"] = $data[$key]["token"];
            }
        }
        file_put_contents($filename, serialize($data));
        echo "<h1>Vous êtes connecté(e).\n";
    }
}
else
{
    echo "<h1>ERROR.\n</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit;
}
?>
<meta http-equiv="refresh" content="1;url=index.php"/>