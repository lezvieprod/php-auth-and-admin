<?php 

session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once './../../vendor/connect.php';

$title = $_POST['title'];
$value = $_POST['value'];
$id = $_POST['id'];


mysqli_query($connect, "UPDATE `claims` SET `title` = '$title', `value` = '$value' WHERE `claims`.`id` = $id");

header('Location: /admin/content.php');
