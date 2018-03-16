<?php

function check_cat($categ, $str)
{
    $tab = preg_split('~;~', $str);
    foreach ($tab as $elem)
    {
        if ($elem == $categ)
            return (TRUE);
    }
    return (FALSE);
}



?>