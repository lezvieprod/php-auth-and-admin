<?php

require_once 'dbconfig.php';


$connect = mysqli_connect($servername, $dblogin, $dbpass, $dbname);
// $connect = new mysqli($servername, $dblogin, $dbpass, $dbname);
// $connect = mysqli_connect('localhost', 'root', 'root', '_test_bd');



if (!$connect) {
    die('Error connect to DataBase');
}