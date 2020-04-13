<?php 
session_start();
$id=$_GET['id'];



include_once '../dbCon.php';
$conn = connect();
$sql = "DELETE FROM `ideas` WHERE `id`=$id";
$result = $conn->query($sql);
header('location:manage-idea.php');



 ?>