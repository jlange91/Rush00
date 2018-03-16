<?php

function auth($login, $passwd)
{
    $filename = "private/passwd";
    $filepath = "private";

    if (!file_exists($filepath))
        mkdir($filepath, 0755);
    if (!file_exists($filename))
        file_put_contents($filename, "");
    if (($data = unserialize(file_get_contents($filename))) == FALSE)
        return FALSE;
    foreach ($data as $key => $value)
    {
        if ($value["login"] === $login)
            if ($value["passwd"] == hash("whirlpool", $passwd))
                return TRUE;
    }
    return FALSE;
}

?>