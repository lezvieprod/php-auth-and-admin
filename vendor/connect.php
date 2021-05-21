<?php
require_once 'dbconfig.php';

if($sokol === 'init') {
    $connect = mysqli_connect($servername, $dblogin, $dbpass, $dbname);
}

if (!$connect) {
    die('Error connect to DataBase');
}