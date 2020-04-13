
<?php  include_once'template/header.php';?>
<?php



include_once '../dbCon.php';
$conn = connect();
$id=$_GET['id'];
$sql = "select * from categories where id=$id";
$result = $conn->query($sql);
$result=mysqli_fetch_assoc($result);

if(isset($_POST['btn'])){
	$id=$_GET['id'];
	   $data=$_POST;
    extract($data);
	$sqli="UPDATE `categories` SET `name`='$category_name',`description`='$category_description',`start_date`='$start_date',`end_date`='$end_date' WHERE `id`=$id";
	
$res=$conn->query($sqli);

 header('location:manage-category.php');
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
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['username']; ?></h2>
              </div>
            </div>
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
            <div class="well" style="height:500px; background-image:url(http://www.spyderonlines.com/images/light_line_form_68555.jpg)" >

               <h1 style="text-align:center;">Edit Category form</h1>
					 <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                <form action="" method="POST" class="form-horizontal">
                  
                    <div class="form-group">
                        <label class="col-sm-3">Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="category_name" class="form-control" value="<?=$result['name']?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Category Description</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="category_description"><?=$result['description'];?></textarea>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Start Date</label>
                        <div class="col-sm-7">
                            <input type="date" name="start_date" class="form-control" value="<?=$result['start_date'];?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">End Date</label>
                        <div class="col-sm-7">
                            <input type="date" name="end_date" class="form-control" value="<?=$result['end_date'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Update Category Info"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	  <script>
        document.forms['editUserForm'].elements['role'].value = '<?php echo row['roles']; ?>';
    </script>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>