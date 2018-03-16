<?php

$mysqli = mysqli_connect("localhost", "root", "root");

if (!mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS site"))
{
    echo "Fail database creation.\n";
    exit();
}
else
{
    echo "Success database creation.\n";
}
if (!mysqli_query($mysqli, "USE site;"))
{
    echo "Fail database connexion.\n";
    exit();
}

system("../../bin/mysql --user=root --password=root site < private/articles.sql");

if (!mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS articles (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    categ TEXT,
    img_path TEXT,
    price INT,
    stock INT,
    PRIMARY KEY (id)
)"))
    echo "Fail articles array creation.\n";
else
    echo "Success articles array creation.\n";


if (!mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS orders (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    login TEXT,
    id_art TEXT,
    PRIMARY KEY (id)
)"))
    echo "Fail orders array creation.\n";
else
    echo "Success orders array creation.\n";

?>