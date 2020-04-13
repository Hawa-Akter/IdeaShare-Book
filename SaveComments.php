<?php
session_start();

include_once 'dbCon.php';
    $conn = connect();
	 $studentId= $_SESSION['id'];
	 $studentRole=$_SESSION['user_role'];
    $data=$_POST;
    extract($data);
	
	$sqlidea="select users.*,idea_name from users,ideas where ideas.students_id=users.id AND ideas.id=".$ideaId;
	$result=$conn->query($sqlidea);
	$result=mysqli_fetch_assoc($result);
	$to=$result['email'];
	$name=$result['name'];
	$subject="New Comment On Ideas";
	$content=$_SESSION['username']." commented on your Idea. The Idea name is \"".$result['idea_name']."\" and The comment is \"".$reply;
	
	if(isset($_POST['anonymousComment'])){
		$content="Anonymous person commented on your Idea. The Idea name is \"".$result['idea_name']."\" and The comment is \"".$reply;
if($studentRole==1){
	$sql="INSERT INTO `comments`( `reply`, `idea_id`,`users_id`,`staffOnstudent_comment`,`anonymous_comment`) VALUES ('$reply','$ideaId','$userId',0,0)"; 
	 if($conn->query($sql)){
        include_once 'Mailer.php';
        //$_SESSION['msg']="Comment Generated Successfully";
		$message.=sendMail($to, $name, $subject, $content);
        header('location:index.php');
    }else{
        $_SESSION['msg']="Comment Insertion Failed";
        header('location:index.php');
	}
}else{
	
	$sqli="INSERT INTO `comments`( `reply`, `idea_id`,`users_id`,`staffOnstudent_comment`,`anonymous_comment`) VALUES ('$reply','$ideaId','$userId',1,0)"; 
	if($conn->query($sqli)){
	
	header('location:index.php');
	}
	else{ echo "not inserted";
	}
}
	}else{
		if($studentRole==1){
	$sql="INSERT INTO `comments`( `reply`, `idea_id`,`users_id`,`staffOnstudent_comment`,`anonymous_comment`) VALUES ('$reply','$ideaId','$userId',0,1)"; 
	 if($conn->query($sql)){
        
        $_SESSION['msg']="Comment Generated Successfully";
		include_once 'Mailer.php';
        header('location:index.php');
		$message.=sendMail($to, $name, $subject, $content);
    }else{
        $_SESSION['msg']="Comment Insertion Failed";
        header('location:index.php');
	}
}else{
	
	$sqli="INSERT INTO `comments`( `reply`, `idea_id`,`users_id`,`staffOnstudent_comment`,`anonymous_comment`) VALUES ('$reply','$ideaId','$userId',1,1)"; 
	if($conn->query($sqli)){
	
	header('location:index.php');
	}
	else{ echo "not inserted";
	}
}
		
	}
   