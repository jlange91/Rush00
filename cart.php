<?php session_start();



function add_to_cart($id, $nb)
{

    $v = 0;
    if ($_SESSION['cart'])
    {
        foreach ($_SESSION['cart'] as $key => $value)
        {
            if ($value['id'] === $id)
            {
                $v = 1;
                $_SESSION['cart'][$key]["nb"] += $nb;
            }

        }
    }
    if ($v === 0)
        $_SESSION['cart'][] = array('id' => $id, 'nb' => $nb);
}

add_to_cart($_POST['id'], $_POST['nb']);
if (isset($_SESSION['cart']) && $_SESSION['cart'] != "")
    echo "<h1>Produit(s) ajouté(s)</h1>";
?>
<meta http-equiv="refresh" content="1;url=index.php"/>