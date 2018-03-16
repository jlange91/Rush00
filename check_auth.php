<?php

function check_auth($login)
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
        {
            if ($value["token"] == "")
                return 0;
            else if ($value["token"] == $_SESSION["token"])
                return $value["status"];
        }
    }
    return 0;
}

?>