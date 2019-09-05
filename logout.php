<?php 
ob_start();
session_start();
unset($_SESSION['username']);
header("Location: index.php");
 ?>