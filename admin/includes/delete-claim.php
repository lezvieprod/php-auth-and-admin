<?php

session_start();

$login = "admin";
$password = "admin";


if ($login !== $_SESSION['login'] && $password !== $_SESSION['password']) {
  header('Location: /admin');
}

require_once "connect.php";

$id = $_GET["id"];

mysqli_query($connect, "DELETE FROM `claims` WHERE `claims`.`id` = $id ");

header('Location: /admin/content.php');

