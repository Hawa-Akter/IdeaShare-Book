<?php
session_start();
$okFlag=true;
include_once 'dbCon.php';
    $conn = connect();
	 $studentId= $_SESSION['id'];
	 
	 if (!isset($_REQUEST['name']) || empty($_REQUEST['name'])) {
    $_SESSION['ideaError']= 'Please type Idea name.<br>';
    $okFlag = FALSE;
	}
	if (!isset($_REQUEST['ideaDetails']) || $_REQUEST['ideaDetails'] == '') {
    $_SESSION['ideaDetailsError']= 'Please type on Idea Details.<br>';
    $okFlag = FALSE;
	}
	 if (!isset($_REQUEST['categories']) || $_REQUEST['categories'] == '') {
    $_SESSION['categoriesError']= 'Please Select a Category.<br>';
    $okFlag = FALSE;
	}
	 
	if($okFlag){
    $data=$_POST;
    extract($data);
	
	$sqlfind="select department_id from users where id=".$studentId;
	$departmentId=$conn->query($sqlfind);
	$departmentId=mysqli_fetch_assoc($departmentId);
	$departmentId=$departmentId['department_id'];
	
	$sqlcoor="select email, name from users where role=3 and department_id=".$departmentId;
	$departmentNE=$conn->query($sqlcoor);
	$departmentNE=mysqli_fetch_assoc($departmentNE);
	$to=$departmentNE['email'];
	$subject="New Idea Submission";
	$content=$_SESSION['username']." Of your Department has posted an Idea. The Idea Name is \"".$name;
	
	
	if(isset($_POST['anonymousPost']) && $_POST['anonymousPost']==1){
		if($_FILES['file']!=null){
			
	require_once 'imageUploader.php';
	if(isset($finalimage)){
	$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`,`file_name`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$finalimage','$categories',' $studentId','$anonymousPost')"; 
	 if($conn->query($sql)){
        include_once 'Mailer.php';
        $_SESSION['msg']="Ideas Created Successfully";
		$message.=sendMail($to, $name, $subject, $content);
        header('location:Idea.php');
    }else{
        $_SESSION['msg']="Ideas Insertion Failed";
        header('location:Idea.php');
    }
		}else{
			$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$categories',' $studentId','$anonymousPost')"; 
	 if($conn->query($sql)){
		 include_once 'Mailer.php';
		   $_SESSION['msg']="Ideas Created Successfully";
		   
		$message.=sendMail($to, $name, $subject, $content);
		header('location:Idea.php');
	 }else{
		$_SESSION['msg']="Ideas Insertion Failed";
		 header('location:Idea.php');
	 }
		}
		
		}else{
		$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$categories',' $studentId','$anonymousPost')"; 
	 if($conn->query($sql)){
		 include_once 'Mailer.php';
		   $_SESSION['msg']="Ideas Created Successfully";
		   
		$message.=sendMail($to, $name, $subject, $content);
		header('location:Idea.php');
	 }else{
		$_SESSION['msg']="Ideas Insertion Failed";
		 header('location:Idea.php');
	 }
	}
	}else{
		if($_FILES['file']!=null){
			
	require_once 'imageUploader.php';
		if($finalimage){
	$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`,`file_name`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$finalimage','$categories',' $studentId',0)"; 
	 if($conn->query($sql)){
         include_once 'Mailer.php';
        $_SESSION['msg']="Ideas Created Successfully";
		$message.=sendMail($to, $name, $subject, $content);
        header('location:Idea.php');
    }else{
        $_SESSION['msg']="Ideas Insertion Failed";
        header('location:Idea.php');
    }
		}else{
			$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$categories',' $studentId',0)"; 
	 if($conn->query($sql)){
		  include_once 'Mailer.php';
		   $_SESSION['msg']="Ideas Created Successfully";
		   $message.=sendMail($to, $name, $subject, $content);
		   header('location:Idea.php');

	 }else{
		$_SESSION['msg']="Ideas Insertion Failed";
		 header('location:Idea.php');
	 }
		}
	}else{
		$sql="INSERT INTO `ideas`( `idea_name`, `idea_details`, `categories_id`,`students_id`,`anonymous_post`) VALUES ('$name','$ideaDetails','$categories',' $studentId',0)"; 
	 if($conn->query($sql)){
		  include_once 'Mailer.php';
		   $_SESSION['msg']="Ideas Created Successfully";
		   $message.=sendMail($to, $name, $subject, $content);
		   header('location:Idea.php');

	 }else{
		$_SESSION['msg']="Ideas Insertion Failed";
		 header('location:Idea.php');
	 }
	}
		
	}
	}
	header('location:Idea.php');
   