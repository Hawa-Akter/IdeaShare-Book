<?php


session_start();

$okFlag = TRUE;
$message = '';

if (!isset($_REQUEST['username']) || $_REQUEST['username'] == '') {
    $message .= 'Please type your name.<br>';
    $okFlag = FALSE;
}
if (!isset($_REQUEST['email']) || $_REQUEST['email'] == '') {
    $message .= 'Please type your email.<br>';
    $okFlag = FALSE;
}
if (!isset($_REQUEST['password']) || $_REQUEST['password'] == '') {
    $message .= 'Please type your password.<br>';
    $okFlag = FALSE;
}


if (isset($_REQUEST['password']) && isset($_REQUEST['confirm-password'])) {
    if ($_REQUEST['password'] != $_REQUEST['confirm-password']) {
        $message .= 'Password didn\'t match with confirm password.<br>';
        $okFlag = FALSE;
    }
}

if ($okFlag) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $pass=$_POST['password'];
   
    
    include_once 'dbCon.php';
    $conn = connect();
    //echo '31:'.$password; exit;
    //Validate Email uniqueness
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    //echo $result->num_rows;
    if ($result->num_rows <= 0) {
        $sql = "INSERT INTO users(name,email,pass,role) VALUES ('$name','$email','$pass',1)";
        //echo $sql; exit;
        if ($conn->query($sql)) {
            //header('location:signup.php?msg=Successfully Registered'); Sending message through get method
            $_SESSION['msg'] = 'Successfully Registered';
            header('location:login.php');
        } else {
            //header('location:signup.php?msg=Database Error');
            $_SESSION['msg'] = 'Database Error';
            header('location:login.php');
        }
    } else {
        header('location:login.php');
         $_SESSION['msg'] = 'email already exist.<br>';
    }
} else {
    $_SESSION['msg'] = $message;
   header('location:login.php');
}
?>