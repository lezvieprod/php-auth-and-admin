<?php 

session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once './../../vendor/connect.php';

$title = $_POST['title'];
$value = $_POST['value'];
$id = $_POST['id'];
$status = $_POST['status'];

$pathNewValue = "uploads/" . time() . $_FILES["imageAfter"]["name"];
move_uploaded_file($_FILES["imageAfter"]['tmp_name'], '../../' . $pathNewValue);

$newValue = $pathNewValue;

mysqli_query($connect, "UPDATE `claims` SET `title` = '$title', `value` = '$value', `status` = '$status', `newValue` = '$newValue' WHERE `claims`.`id` = $id");

header('Location: /admin/content.php');
