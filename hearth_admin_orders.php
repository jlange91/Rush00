<?php 
if (check_auth($_SESSION["logged_on_user"]) != 2)
{
    echo "<h1>Barre toi y a rien a voir</h1>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\"/>";
    exit();
}

?>  <style>
/*
    table, td{
        border: 3px solid black;
    }
*/

    #tab_admin_cart{
        border-collapse: collapse;
        width: 100%;
    }

    #tab_admin_cart td {
        border-bottom: 1px solid #e1e1e1;
        text-align: left;
        padding: 8px;
    }

    #tab_amin_cart tr:nth-child(even){background-color: #f2f2f2}
</style>  <?php

$mysqli = mysqli_connect("localhost", "root", "root", "site");
if ($rep = mysqli_query($mysqli, 'SELECT * FROM orders')){
    echo "
        <div id=\"hearth\">
                <div id=\"hearth_admin\">
                    <div id=\"article_admin\">
                        <div class=\"gallery_admin\">
                            <div class=\"desc_admin\">
                                <table id=\"tab_admin_cart\">     
                                    <tr>
                                        <td>ex: Cart X<br/>by [login]</td>
                                    </tr>
                                    <tr>
                                        <td>ex: id<br/><br/><br/><br/></td>
                                        <td>ex: nb<br/><br/><br/><br/></td>
                                    </tr>";
    $i = 1;
    while ($donnees = mysqli_fetch_assoc($rep))
    {
        echo "
        <tr>
            <td>Cart: ".$i."<br/>by user: " . $donnees['login'] . "</td>
        </tr>";
        $tab1 = preg_split("/;/", $donnees['id_art']);
        foreach ($tab1 as $tmp)
        {
            $tab2 = preg_split("/:/", $tmp);
            if ($tab2[0] && $tab2[1])
            {
                echo "
                <tr>
                    <td>" . $tab2[0] . "</td>
                    <td>" . $tab2[1] . "</td>
                </tr>";
            }
        }
        $i++;
    }
    echo "</table></div></div></div></div></div>";
    mysqli_free_result($rep);
    if ($mysqli)
        mysqli_close($mysqli);
}
$tab1 = "";

?>