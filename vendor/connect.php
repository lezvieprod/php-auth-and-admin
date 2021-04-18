<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'bitready');

if (!$connect) {
    die('Error connect to DataBase');
}