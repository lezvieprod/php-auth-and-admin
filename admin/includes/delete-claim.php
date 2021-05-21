<?php

session_start();
if (!$_SESSION['user']) {
  header('Location: /');
}
header('Location: /admin/content.php');

require_once './../../vendor/connect.php';

$id = $_GET["id"];

mysqli_query($connect, "DELETE FROM `claims` WHERE `claims`.`id` = $id ");



