<?php 
session_start();
$id=$_GET['id'];



include_once '../dbCon.php';
$conn = connect();
$sql = "UPDATE `ideas` SET `publication_status`=1 WHERE `id`=$id";
$result = $conn->query($sql);
 if($conn->query($sql)){
        
        $_SESSION['msg']="Idea Published Successfully";
		
        header('location:manage-idea.php');
    }else{
        $_SESSION['msg']="Idea Publish Failed";
       header('location:manage-idea.php');
    }




 ?>