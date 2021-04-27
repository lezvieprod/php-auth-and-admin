<?php

session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once './../../vendor/connect.php';

$title = $_POST['title'];
$author = $_SESSION['user']['login'];
$status = 0;

if($_FILES["image"]["name"]) {
  $path = "uploads/" . time() . $_FILES["image"]["name"];
  move_uploaded_file($_FILES["image"]['tmp_name'], '../../' . $path);
  
  $value = $path;
  $title && $value ? mysqli_query($connect, "INSERT INTO `claims` (`id`, `author` , `title`, `value`, `status`) VALUES (NULL, '$author' , '$title', '$value', '$status') ") : null;
  
}



header('Location: /');
