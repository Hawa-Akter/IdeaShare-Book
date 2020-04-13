<?php
session_start();
 if(!isset($_SESSION['user_role'])){
	header('location:login.php');
} 
if(isset($_SESSION['user_role']) && ($_SESSION['user_role']==2 || $_SESSION['user_role']==0)){
	header('location:index.php');
}
include_once 'dbCon.php';
$conn = connect();
$userId=$_SESSION['id'];




$name="";
$email="";
$password="";



if(isset($_POST['btn'])){
	
	


	if($_FILES['file']['name']!=null){
	require_once 'imageUploader.php';
	if(isset($finalimage)){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql="Update users SET name='$name', email='$email',image_name='$finalimage' where id=$userId";
	     $_SESSION['imageName']=$finalimage;
	$conn->query($sql);
	}else{
		$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="Update users SET name='$name', email='$email' where id=$userId";
	$conn->query($sql);
	$_SESSION['msg']="Profile Updated Successfully";
	}
	}else{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="Update users SET name='$name', email='$email' where id=$userId";
	$conn->query($sql);
	$_SESSION['msg']="Profile Updated Successfully";
	}

	
	$okFlag=true;
	if($_POST['password']!=null){
		
	
	if (!isset($_REQUEST['password']) || $_REQUEST['password'] == '') {
    $passError= 'Please type your password.<br>';
    $okFlag = FALSE;
	}else{
		if(strlen($_REQUEST['password'])<=12 && strlen($_REQUEST['password'])>=6){
		$password=md5($_POST['password']);
		}else{
			$passError= 'Password Should be between 6 to 12 charecter.<br>';
			$okFlag = FALSE;
		}
	}
	if (!isset($_REQUEST['conpassword']) || $_REQUEST['conpassword'] == '') {
    $conpassError= 'Confirm Your password.<br>';
    $okFlag = FALSE;
	}
	if (isset($_REQUEST['password']) && isset($_REQUEST['conpassword'])) {
			if ($_REQUEST['password'] != $_REQUEST['conpassword']) {
				$conpassError= 'Password didn\'t match with confirm password.<br>';
				$okFlag = FALSE;
			}
		}
	
	
	if($okFlag){
		$pas=md5($_POST['password']);
		$swl="UPDATE users SET `pass`='$pas' where id='$userId'";
		if($conn->query($swl)){
			
			$_SESSION['msg']="Updated Successfully";
		}else{
			
			$_SESSION['msgerror']="Profile Update Failed";
		}
	}else{
		$_SESSION['msgerror']="Profile Update Failed";
	}
	}
	
}


$sqlone="SELECT users.*, department.department_name from Users,department where users.department_id=department.id and users.id='$userId'";
$userprofile = $conn->query($sqlone);
$userprofile=mysqli_fetch_assoc($userprofile );


$sqlj="select ideas.idea_name,ideas.idea_details,categories.name from users,ideas,categories where users.id=ideas.students_id and ideas.categories_id=categories.id and users.id=$userId order By ideas.id DESC";
$ownIdeas = $conn->query($sqlj);
 ?>

<?php  include_once'Mastering/header.php';?>
  


            <!-- sidebar menu -->
          
        <!-- top navigation -->
		<?php include_once'Mastering/nav-bar.php';?>
<!-- /top navigation -->

        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="padding-left:5%;"><?=$userprofile['name']?> <small>(<?php if($userprofile['role']==1){echo "Student";}elseif($userprofile['role']==2){echo "QA Manager";}elseIf($userprofile['role']==3){echo "Co Ordinator";}?>)</small></h2>
                    <div class="clearfix"></div>
                  </div>
						<h4 class="text-center text-danger">
						<?php
                        if (isset($_SESSION['msgerror'])) {
                            echo $_SESSION['msgerror'];
						unset($_SESSION['msgerror']);  ?></h4>
							<h4 class="text-center text-success"><?php 
                        }elseif(isset($_SESSION['msg'])){
							 echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
						}
                        ?></h4>
                  <div class="x_content">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
						<form action="" method="POST" class="form-horizontal"  enctype="multipart/form-data">
						<?php if($userprofile['image_name']!=null) {?>
						<img class="img-responsive avatar-view" src="<?=$userprofile['image_name']?>" height="200px" width="200px" alt="Avatar" title="Change the avatar">
						<?php }else{ ?>
							 <img class="img-responsive avatar-view" src="http://www.bsmc.net.au/wp-content/uploads/No-image-available.jpg" alt="Avatar" title="Change the avatar">
						<?php } ?>
						  <div class="col-sm-12 form-group">
									 <input type="file" name="file" class="form-control"/>
								</div>
                        </div>
						
                      </div>
					  
                      <h3>Personal Info</h3>
					 
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">ID</label>
								<div class="col-sm-8">
									<input type="number" name="userid" disabled class="form-control" value="<?=$userprofile['id']?>"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Name</label>
								<div class="col-sm-8">
									<input type="text" name="name" required class="form-control" value="<?=$userprofile['name']?>"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Department</label>
								<div class="col-sm-8">
									<input type="text" name="departmentName"  class="form-control" disabled value="<?=$userprofile['department_name']?>"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Email</label>
								<div class="col-sm-8">
									<input type="text" name="email" required class="form-control" value="<?=$userprofile['email']?>"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Reset Password</label>
								<div class="col-sm-8">
									<input type="password" name="password"  class="form-control"/>
									<h4 class="text-danger"><?php if (isset($passError)) {echo ($passError);unset ($passError);}?></h4>
									</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4"> Confirm New Password</label>
								<div class="col-sm-8">
									<input type="password" name="conpassword"  class="form-control"/>
									<h4 class="text-danger"><?php if (isset($conpassError)) {echo ($conpassError);unset ($conpassError);}?></h4>
								</div>
							</div>
					
                      <input type="submit" class="btn btn-primary" name="btn" value="Update Profile" />
					  </form>
                      <br />

                      
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" 
						  data-toggle="tab" aria-expanded="true">Own Ideas</a>
                          </li>
                          
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
							<?php $i=0; ?>
							<?php foreach($ownIdeas as $ownIdea){ ?>
							<?php $i++; ?>
                            <ul class="messages">
                              <li style="list-style:none;">
                               <!--image of Idea-->
                                <div class="message_wrapper">
                                  <h4 class="heading" ><?=$i;?>. <?=$ownIdea['idea_name']?></h4>
                                  <blockquote class="message"><?=$ownIdea['idea_details']?></blockquote>
                                  <br />
                                </div>
                              </li>
                              
                            </ul>
							<?php } ?>
                            <!-- end recent activity -->

                          </div>
						  </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
      <?php include_once'Mastering/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'Mastering/foot-scripts.php';?>