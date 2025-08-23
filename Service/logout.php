<?php 
session_start();
require "../assets/php/connect.php";

unset($_SESSION['email']);

session_unset();
session_destroy();
header('Location: index');
exit();
?>