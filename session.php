<?php 
session_start();

if (!isset($_SESSION['cmuitaccount'])) {
  header('Location: index');
  exit();
}

require "assets/php/connect.php";

$result = mysqli_query($conn, "SELECT maintenance FROM admin WHERE id = 1");
$row = $result->fetch_assoc();
$maintenance = $row['maintenance'];

if ($_SESSION['organization_name_EN'] != 'Faculty of Education') {
  header('Location: permission');
  session_destroy();
}

if ($_SESSION['student_id'] == '' && $_SESSION['user_type'] != 'admin') {
  header('Location: permission');
  session_destroy();
}

if ($maintenance == 1 && $_SESSION['user_type'] != 'admin') {
  header('Location: maintenance');
  session_destroy();
}


?>