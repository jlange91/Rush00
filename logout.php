<?php session_start();

$filename = "private/passwd";
$pathname = "private/";

if (!file_exists($pathname))
    mkdir($pathname);
if (file_exists($filename))
    $data = unserialize(file_get_contents($filename));
foreach ($data as $key => $value)
{
    if ($value["login"] === $_SESSION['logged_on_user'])
            $data[$key]["token"] = "";
}
file_put_contents($filename, serialize($data));
$_SESSION['logged_on_user'] = "";
$_SESSION['token'] = "";
echo "<h1>Vous avez été déconnecté\n</h1>";
echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";

?>