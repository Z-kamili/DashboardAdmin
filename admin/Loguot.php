<?php 
session_start();
$_SESSION["user"] = null;
header("Location:http://localhost/REDA/admin/Login.php");
?>