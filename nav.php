<div id="th"><span id="title"><img src="img/icon.site.png" weight=100 height=100 /><img src="img/42_logo_black.svg" height=60 width=60 />Subjects</span>
<div id="cart"><a href="orders.php"><img src="img/icon_cart.png" weight=100 height=100 /></a><div id="nb_cart"><?php

$nb = 0;
if (isset($_SESSION['cart']) && $_SESSION['cart'] != "")
{
    foreach($_SESSION['cart'] as $tab)
	    foreach($tab as $key => $value)
	    	if ($key == "nb")
		    	$nb = $nb + $value;
}
echo $nb;

?></div>
</div></div>
<ul id="parent">
    <li><a href="index.php">HOME</a></li>
    <li><a href="">BRANCHES</a>
        <ul>
            <li class="down"><a href="index.php?cat=1">Algorithmique</a></li>
            <li class="down"><a href="index.php?cat=2">Graphiques</a></li>
            <li class="down"><a href="index.php?cat=3">Unix</a></li>
            <li class="down"><a href="index.php?cat=4">Web</a></li>
            <li class="down"><a href="index.php?cat=5">Others</a></li>
        </ul></li>
    <li><a href="#3">NIVEAUX</a>
        <ul>
            <li class="down"><a href="index.php?cat=21">T1</a></li>
            <li class="down"><a href="index.php?cat=22">T2</a></li>
            <li class="down"><a href="index.php?cat=23">T3</a></li>
        </ul></li>
</ul>
