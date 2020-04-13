
<?php  include_once'template/header.php';?>
<?php 

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0){ 
include_once '../dbCon.php';
    $conn = connect();


If(isset($_POST['btn'])){
	$data=$_POST;
    extract($data);
	 $sql = "INSERT INTO department(department_name) VALUES ('$departmentName')";

	 if($conn->query($sql)){
		  $_SESSION['msg']="Cateogry Added Successfully";
		 
	 }else{
		  $_SESSION['msg']="Cateogry Not Added";
	 }
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
            <div class="well" style="height:;">

               <h1 style="text-align:center;">Add Department form</h1>
			   <h4 style="text-align:center;"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                  ?></h4>

                <form action="" method="POST" class="form-horizontal">
                   
                    <div class="form-group">
                        <label class="col-sm-3">Department Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="departmentName" class="form-control"/>
                        </div>
                    </div>
		            <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-info btn-block" value="Save User Information"/>
                        </div>
                    </div>
                    
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