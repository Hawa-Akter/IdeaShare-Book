<?php
session_start();
include_once '../dbCon.php';
    $conn = connect();
	$okFlag=true;
	if(empty($_POST['category_name']) || is_numeric($_POST['category_name'])){
		$_SESSION['CategoryNameError']= "Category name Cannot Be Empty or Numeric Value";
		$okFlag=False;
	}
	if(empty($_POST['category_description']) || strlen($_POST['category_description'])<=10){
		$_SESSION['CategoryNameError']= "Category Details Cannot Be Empty or less than 10 letter";
		$okFlag=False;
	}
	
	if($okFlag){
    $data=$_POST;
    extract($data);
	 
	$sql="INSERT INTO `categories`( `name`, `description`, `start_date`, `end_date`) VALUES ('$category_name','$category_description','$start_date','$end_date')"; 
	 if($conn->query($sql)){
        
        $_SESSION['msg']="Cateogry Added Successfully";
		
        header('location:addCategory.php');
    }else{
        $_SESSION['msg']="Cateogry Insertion Failed";
        header('location:addCategory.php');
    }
	}header('location:addCategory.php');
    
   
   