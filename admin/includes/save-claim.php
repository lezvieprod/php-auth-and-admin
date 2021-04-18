<?php 

session_start();

$login = "admin";
$password = "admin";

if ($login !== $_SESSION['login'] && $password !== $_SESSION['password']) {
  header('Location: /admin');
}

require_once "connect.php";

$title = $_POST['title'];
$value = $_POST['value'];
$id = $_POST['id'];


mysqli_query($connect, "UPDATE `claims` SET `title` = '$title', `value` = '$value' WHERE `claims`.`id` = $id");

header('Location: /admin/content.php');
