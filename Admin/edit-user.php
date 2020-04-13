
<?php  include_once'template/header.php';?>

<?php
include_once '../dbCon.php';
$conn = connect();
$id=$_GET['id'];
$sql = "select * from users where id=$id";
$result = $conn->query($sql);
$result=mysqli_fetch_assoc($result);

$sqldp = "select * from department";
$resultdp = $conn->query($sqldp);

if(isset($_POST['btn'])){
	$id=$_GET['id'];
	   $data=$_POST;
    extract($data);
	 if($_POST['role']==2 || $_POST['role']==0){
		 if(!empty($_POST['password'])){
			 if(strlen($_REQUEST['password'])<=12 && strlen($_REQUEST['password'])>=6){
				 $password=md5($_POST['password']);
				 $sqli="UPDATE `users` SET `name`='$name',`email`='$email',`pass`='$password' WHERE `id`=$id";
				 if($conn->query($sqli)){
					 $_SESSION['msg']="User Updated Successfully";
				 }else{
					 $_SESSION['msgerror']="User update Failed.<br>";
					
				 };
			 }else{
				  $_SESSION['msgerror'].= 'Password Should be between 6 to 12 charecter.<br>';
				 
			 }	 
		 }else{
			 $sqli="UPDATE `users` SET `name`='$name',`email`='$email' WHERE `id`=$id";
			 if($conn->query($sqli)){
				 $_SESSION['msg']="Admin Updated Successfully.<br>";
			 }else{
				 $_SESSION['msgerror']="Admin update Failed";
			 };
		 }
	 }else{
	
		$sqli="UPDATE `users` SET `name`='$name',`email`='$email',`role`='$role',`department_id`=$department WHERE `id`=$id";
	
			if($conn->query($sqli)){
			$_SESSION['msg']="User Updated Successfully";
		}else{
		 $_SESSION['msgerror']="User update Failed";
		};
	 }
 header('location:manage-user.php');
}

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
            <div class="well" style="height:500px; background-image:url(images/back.jpg)" >
<div class="well" style="height:;">

               <h1 style="text-align:center;">Edit User's Info</h1>

                <form action="" name="editUserForm" method="POST" class="form-horizontal">
                   
                    <div class="form-group">
                        <label class="col-sm-3">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="<?=$result['name'];?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" value="<?=$result['email'];?>"/>
                        </div>
                    </div>
					<?php if($result['role']==2 || $result['role']==0){ ?>
					<div class="form-group">
                        <label class="col-sm-3">Reset Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control"/>
                        </div>
						<h4 class="text-danger"><?php if (isset($passError)) {echo ($passError);unset ($passError);}?></h4>
                        
                    </div>
					<?php } ?>
					<div class="form-group">
                        <label class="col-sm-3">User type</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control" style="height:40px;">
                                <option value="">---Select user---</option>
								
                                <option value="1">Student</option>
                                <option value="2">Manager</option>
                                <option value="3">Course Coordinator</option>
                                
                            </select>
                        </div>
                    </div>
					<?php if($result['role']==1 || $result['role']==3){ ?>
					<div class="form-group">
                        <label class="col-sm-3">Department</label>
                        <div class="col-sm-9">
                            <select name="department" class="form-control" style="height:40px;">
                                <option>---Select department---</option>
								<?php foreach($resultdp as $row){?>
                                <option value="<?=$row['id']?>"><?=$row['department_name']?></option>
                                <?php } ?>
                               
                                
                            </select>
                        </div>
                    </div>
					<?php } ?>
					
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-info btn-block" value="Save User Information"/>
                        </div>
                    </div>
                    
                </form>
				<script>
				document.forms['editUserForm'].elements['role'].value = '<?php echo $result['role']; ?>';
				document.forms['editUserForm'].elements['department'].value = '<?php echo $result['department_id']; ?>';
				</script>
            </div>
       </div>
    </div>
        <!-- /page content -->
	
        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	  <script>
		
        
    </script>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>