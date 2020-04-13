<?php

//Login Checker
session_start();
$okFlag = TRUE;
$emailError = '';
$passError = '';

if (!isset($_REQUEST['email']) || $_REQUEST['email'] == '') {
$_SESSION['emailError']= 'Please type your email.<br>';
    $okFlag = FALSE;
}else{
	$_SESSION['emailofLogin']=$_REQUEST['email'];
}
if (!isset($_REQUEST['pass']) || $_REQUEST['pass'] == '') {
    $_SESSION['passError']= 'Please type your password.<br>';
    $okFlag = FALSE;
}

if ($okFlag) {
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
  

    if (!isset($_SESSION['login_counter']))
        $_SESSION['login_counter'] = 0;

    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    include_once 'dbCon.php';
    $conn = connect();

    $result = $conn->query($sql);
    //echo $result->num_rows;
    if ($result->num_rows > 0) {
        $_SESSION['isLoggedIn'] = TRUE;
        
        foreach ($result as $row) {
            $_SESSION['username'] = $row['name'];
            $_SESSION['id']=$row['id'];
            $_SESSION['user_role']=$row['role'];
			$_SESSION['email']=$row['email'];
			$_SESSION['imageName']=$row['image_name'];
			
        }
		
        header('location:index.php');
    } else {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        //Checking if the email is in database
        if ($result->num_rows <= 0) {
            $_SESSION['emailError']= 'Email Not Exist <br>';
            header('location:login.php');
        } else {
            $_SESSION['input_email'] = $email;
            $_SESSION['passError']= 'Password didn\'t match<br>';
            header('location:login.php');
        }

    }
} else {
    $_SESSION['msg'] = $message;
    header('location:login.php');
}
