<?php

session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once './../../vendor/connect.php';

$title = $_POST['title'];

if($_POST['type'] == 1) {
  $value = $_POST['value'];
  mysqli_query($connect, "INSERT INTO `claims` (`id`, `title`, `value`) VALUES (NULL, '$title', '$value') ");
} else {

  $path = "uploads/" . time() . $_FILES["image"]["name"];
  move_uploaded_file($_FILES["image"]['tmp_name'], '../' . $path);

  $value = "admin/" . $path;
  mysqli_query($connect, "INSERT INTO `claims` (`id`, `title`, `value`) VALUES (NULL, '$title', '$value') ");
}

header('Location: /admin/content.php');
