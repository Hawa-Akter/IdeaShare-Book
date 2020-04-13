
<?php  include_once'template/header.php';?>
<?php 

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0){ 
include_once '../dbCon.php';
    $conn = connect();
$okFlag = TRUE;
$nameError="";
$emailError="";
$passError="";
$roleError="";
If(isset($_POST['btn'])){
	
	if(empty($_POST['name']) || is_numeric($_POST['name'])){
		$nameError= "Name Cannot Be Empty or Numeric Value";
		$okFlag=False;
	}else{
		$name=$_POST['name'];
	}
	if (!isset($_REQUEST['email']) || $_REQUEST['email'] == '') {
    $emailError= 'Please type Correct email Format.<br>';
    $okFlag = FALSE;
	}else{
		$emai=$_POST['email'];
		$sql="SELECT email from users where email='$emai'";
		$result=$conn->query($sql);
		$result=mysqli_num_rows($result);
		if($result==1){
			$emailError= 'Email has already Exist.<br>';
			$okFlag=FALSE;
		}else{
			$email=$_POST['email'];
		}
	}
	if (!isset($_REQUEST['pass']) || $_REQUEST['pass'] == '') {
    $passError= 'Please type your password.<br>';
    $okFlag = FALSE;
	}else{
		if(strlen($_REQUEST['pass'])<=12 && strlen($_REQUEST['pass'])>=6){
		$pass=md5($_POST['pass']);
		}else{
			$passError= 'Password Should be between 6 to 12 charecter.<br>';
			$okFlag = FALSE;
		}
	}
	if (!isset($_REQUEST['conpass']) || $_REQUEST['conpass'] == '') {
    $conpassError= 'Confirm Your password.<br>';
    $okFlag = FALSE;
	}
	if (isset($_REQUEST['pass']) && isset($_REQUEST['conpass'])) {
			if ($_REQUEST['pass'] != $_REQUEST['conpass']) {
				$conpassError= 'Password didn\'t match with confirm password.<br>';
				$okFlag = FALSE;
			}
		}
	if (!isset($_REQUEST['role']) || empty($_REQUEST['role'])) {
    $roleError='Please Select User Type.<br>';
    $okFlag = FALSE;
	}else{
		$role=$_POST['role'];
	}
	
	if($okFlag){
		
	
		if($role==2){

				$sql = "INSERT INTO users(name,email,pass,role,department_id) VALUES ('$name','$email','$pass','$role',0)";
				 if($conn->query($sql)){
					 $_SESSION['msg']="New Manager Added Successfully";
					 header('location:manage-user.php');
				 }else{
					 $_SESSION['msg']="Manager insertion Failed";
				 }
		}elseif($role==3){
			$department=$_POST['department'];
			 $sql = "INSERT INTO users(name,email,pass,role,department_id) VALUES ('$name','$email','$pass','$role',5)";
			 if($conn->query($sql)){
				 $_SESSION['msg']="New User Added Successfully";
				 header('location:manage-user.php');
			 }else{
				 $_SESSION['msg']="User insertion Failed";
			 }
		}else{
			if (!isset($_REQUEST['department']) || empty($_REQUEST['department'])) {
				$departmentError='Please Select Department Name.<br>';
				$okFlag = FALSE;
				}else{
					$department=$_POST['department'];
					 $sql = "INSERT INTO users(name,email,pass,role,department_id) VALUES ('$name','$email','$pass','$role','$department')";
					 if($conn->query($sql)){
						 $_SESSION['msg']="New User Added Successfully";
						 header('location:manage-user.php');
					 }else{
						 $_SESSION['msg']="User insertion Failed";
					 }
				}
			
		}
	}
}

$sql = "select * from department";
$result = $conn->query($sql);
 




?>

   <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
               <a href="#" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $_SESSION['username']; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
			<?php  include_once'template/admin-profile.php';?>

            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
      <?php include_once'template/side-bar.php';?>
        <!-- top navigation -->
		<?php include_once'template/navbar.php';?>
<!-- /top navigation -->

        <!-- page content -->
		<div class="row">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="well" style="height:;">

               <h1 style="text-align:center;">Add User form</h1>
					 <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                <form action="" method="POST" class="form-horizontal">
                   
                    <div class="form-group">
                        <label class="col-sm-3">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="<?php if(isset($name)){echo $name;} ?>"/>
							<h4 class="text-danger"><?php if (isset($nameError)) {echo ($nameError);unset ($nameError);}?></h4>
                        </div>
						
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" value="<?php if(isset($email)){echo $email;} ?>"/>
							<h4 class="text-danger"><?php if (isset($emailError)) {echo ($emailError);unset ($emailError);}?></h4>
                        
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="pass" class="form-control"/>
							<h4 class="text-danger"><?php if (isset($passError)) {echo ($passError);unset ($passError);}?></h4>
                        
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="conpass" class="form-control"/>
							<h4 class="text-danger"><?php if (isset($conpassError)) {echo ($conpassError);unset ($conpassError);}?></h4>
                        
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">User type</label>
                        <div class="col-sm-9">
                            <select name="role" id="role" class="form-control" style="height:40px;">
                                <option value="">---Select user---</option>
                                <option value="1">Student</option>
                                <option value="2">Manager</option>
                                <option value="3">Course Coordinator</option>
                                
                            </select>
							<h4 class="text-danger"><?php if (isset($roleError)) {echo ($roleError);unset ($roleError);}?></h4>
                        
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Department</label>
                        <div class="col-sm-9">
                            <select name="department" id="department" class="form-control" style="height:40px;">
                                <option value="">---Select department---</option>
								<?php foreach($result as $row){?>
                                <option value="<?=$row['id']?>"><?=$row['department_name']?></option>
                                <?php } ?>
                  
                                
                            </select>
							<h4 class="text-danger"><?php if (isset($departmentError)) {echo ($departmentError);unset ($departmentError);}?></h4>
                        
                        </div>
                    </div>
					
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-info btn-block" value="Save User Information"/>
                        </div>
                    </div>
                     <script>
        $(document).ready(function () {


            $('#role').on('change', function() {
                var role = $('#role').val();

                if(role==2) {
                    $('#department').attr('disabled', true);
                }else{
                    $('#department').attr('disabled', false);
                }
            });
        });

    </script>
                </form>
            </div>
        </div>
    </div>
        <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
	  <?php } else { echo "Not Authorised";} ?>