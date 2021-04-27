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

if($_FILES["imageBefore"]["name"]) {
  $path = "uploads/" . time() . $_FILES["imageBefore"]["name"];
  move_uploaded_file($_FILES["imageBefore"]['tmp_name'], '../../' . $path);
  $value = $path;
} else {
  $res = mysqli_query($connect, "SELECT `value` FROM `claims` WHERE `claims`.`id` = $id ");
  $resArray = mysqli_fetch_assoc($res);
  $value = $resArray['value'];
}

if($_FILES["imageAfter"]["name"]) {
  $pathNewValue = "uploads/" . time() . $_FILES["imageAfter"]["name"];
  move_uploaded_file($_FILES["imageAfter"]['tmp_name'], '../../' . $pathNewValue);
  $newValue = $pathNewValue;
} else {
  $res = mysqli_query($connect, "SELECT `newValue` FROM `claims` WHERE `claims`.`id` = $id ");
  $resArray = mysqli_fetch_assoc($res);
  $newValue = $resArray['newValue'];
}





mysqli_query($connect, "UPDATE `claims` SET `title` = '$title', `value` = '$value', `status` = '$status', `newValue` = '$newValue' WHERE `claims`.`id` = $id");

header('Location: /admin/content.php');
