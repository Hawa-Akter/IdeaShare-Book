<?php 
session_start();
$id=$_GET['id'];



include_once '../dbCon.php';
$conn = connect();
$sql = "DELETE FROM `categories` WHERE `id`=$id";
$result = $conn->query($sql);
header('location:manage-category.php');
$_SESSION['msgerror']="Category Info succcessfully Deleted!!"


 ?>