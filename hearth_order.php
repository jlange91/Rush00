
<div id="hearth">

    <?php include("check_cat.php"); ?>

    <?php 

    function add_to_cart_in_order($id)
    {

        if ($_SESSION['cart'])
        {
            foreach ($_SESSION['cart'] as $key => $value)
            {
                if ($value['id'] === $id)
                {
                    $_SESSION['cart'][$key]["nb"] += 1;
                }

            }
        }
    }

    if ($_POST['submit'] === "+")
        add_to_cart_in_order($_POST['id']);
    
    function del_to_cart_in_order($id)
    {

        if ($_SESSION['cart'])
        {
            $i = 0;
            $v = 0;
            while ($_SESSION['cart'][$i])
            {
                if ($_SESSION['cart'][$i]['id'] === $id)
                {
                    $v = $i;
                    $_SESSION['cart'][$i]["nb"] -= 1;
                }
                $i++;
            }
            if ($_SESSION['cart'][$v]['nb'] === 0 || $_SESSION['cart'][$v]['nb'] < 0)
            {
                unset($_SESSION['cart'][$v]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
    }
    
    if ($_POST['submit'] === "-")
        del_to_cart_in_order($_POST['id']);

    ?>

    <?php 
    if ($_SESSION['cart'])
    {
        $total = 0;
        $mysqli = mysqli_connect("localhost", "root", "root", "site");
        $rep = mysqli_query($mysqli, 'SELECT * FROM articles');
        while ($donnees = mysqli_fetch_assoc($rep))
        {
            $i = 0;
            while ($_SESSION['cart'][$i])
            {
                $id = $_SESSION['cart'][$i]['id'];
                $nb = $_SESSION['cart'][$i]['nb'];
                if ($donnees['id'] === $id)
                {
                    $sous_total = $donnees['price'] * $nb;
                    $total = $total + $sous_total;
                    echo "
<div class=\"article_order\">
<div class=\"gallery_order\">
<img src=".$donnees['img_path']." alt=\"test\" width=\"300\" height=\"200\" />
<div class=\"desc_order\">
<div id=\"price_order\">Price : ".$donnees['price']." €</div>
Subtotal : ".$sous_total." €
<form enctype=\"multipart/form-data\" action=\"orders.php\" method=\"post\">
<input type=\"hidden\" name=\"id\" value=".$donnees['id'].">
<input id=\"Add_Button\" type=\"submit\" name=\"submit\" value=\"+\" />
</form>
Quantity : ".$nb."
<form enctype=\"multipart/form-data\" action=\"orders.php\" method=\"post\">
<input type=\"hidden\" name=\"id\" value=".$donnees['id'].">
<input id=\"Add_Button\" type=\"submit\" name=\"submit\" value=\"-\" />
</form>
</div>
</div>
</div>";
                }
                $i++;
            }
        }
        echo "<p>Total: ". $total . "€</p>";
        echo "<a href=\"add_orders.php\"><input type=\"button\" name=\"add_orders\" value=\"Cart Valid\" /></a>";
    }
    else
        echo "Panier vide";
    ?>
    <div class=\"clearfix\"></div>
    
</div>