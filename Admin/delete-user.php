<?php 
session_start();
$id=$_GET['id'];



include_once '../dbCon.php';
$conn = connect();
$sql = "DELETE FROM `users` WHERE `id`=$id";
$result = $conn->query($sql);
header('location:manage-user.php');
$_SESSION['msgerror']="User Info succcessfully Deleted!!"


 ?>