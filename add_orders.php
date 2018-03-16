<?php session_start();
include ("check_auth.php");
$ret = check_auth($_SESSION["logged_on_user"]);
if ($ret != 1 && $ret != 2)
{
	echo "<h1>You must be connected</h1>";
	echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
	exit();
}
if (!isset($_SESSION['cart']) || $_SESSION['cart'] == "")
{
	echo "<h1>Le panier est vide</h1>";
	echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
	exit();
}

$str = "";


$mysqli = mysqli_connect("localhost", "root", "root", "site");


foreach($_SESSION['cart'] as $tab)
{
	if (!$rep = mysqli_query($mysqli, 'SELECT * FROM articles')){
		echo "<h1>SQL ERROR</h1>";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
		exit();}
	while ($donnees = mysqli_fetch_assoc($rep))
	{
		if ($tab["id"] == $donnees["id"])
		{
			$count = $donnees["stock"] - $tab["nb"];
			if ($count < 0)
			{
				echo "<h1>Pas assez de stock pour l'article id:" . $tab["id"] . "</h1>";
				exit();
			}
			else
			{
				$t1[] = $tab["id"];
				$t2[] = $count;
			}
		}
	}
	foreach($tab as $key => $value)
	{
		$str = $str . $tab[$key];
		if ($key == "id")
		{
			$str = $str . ":";
		}
	}
	$str = $str . ";";
}
$_SESSION['cart'] = "";

foreach ($t2 as $key => $value)
{
	$tmp = $t1[$key];
	$value = mysqli_real_escape_string($mysqli, $value);
	$tmp = mysqli_real_escape_string($mysqli, $tmp);
	$rep = mysqli_query($mysqli, "UPDATE `articles` SET stock=".$value." WHERE id=".$tmp.";");
	if (!$rep)
	{
		echo "<h1>SQL ERROR</h1>";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
		exit();
	}
	
}

$mysqli = mysqli_connect("localhost", "root", "root", "site");
$stmt = mysqli_prepare($mysqli, 'INSERT INTO `orders`(`id`, `login`, `id_art`) VALUES (NULL, ?, ?)');
mysqli_stmt_bind_param($stmt, "ss", $_SESSION['logged_on_user'], $str);
$rep = mysqli_stmt_execute($stmt);
if ($mysqli)
	mysqli_close($mysqli);
echo "<h1>SUCCESS</h1>";
?>
<meta http-equiv="refresh" content="1;url=index.php"/>