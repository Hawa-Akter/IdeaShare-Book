

<?php  include_once'template/header.php';?>
<?php

if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 2 ||$_SESSION['user_role'] == 0)){
		



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
            <div class="well" style="height:500px; background-image:url(images/add-Category.jpg)" >

               <h1 style="text-align:center;">Add Category form</h1>
					 <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                <form action="add-category-controller.php" method="POST" class="form-horizontal">
                  
                    <div class="form-group">
                        <label class="col-sm-3">Category Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="category_name" class="form-control"/>
							<h5 class="text-danger"><?php if (isset($_SESSION['CategoryNameError'])) {echo ($_SESSION['CategoryNameError']);unset ($_SESSION['CategoryNameError']);}?></h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Category Description</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="category_description"></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-3">Start Date</label>
                        <div class="col-sm-7">
                            <input id="startDate" type="date" name="start_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" required/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">End Date</label>
                        <div class="col-sm-7">
                            <input id="endDate" type="date" name="end_date" class="form-control" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Save Category Info"/>
                        </div>
                    </div>
                </form>
				
            </div>
			<script>
$(document).ready(function () {
	
  $('#startDate').on('change', function() { 
    var datearray = $('#startDate').val().split("-");

   
	
    var day =datearray[2];
    var month =datearray[1];
    var year = datearray[0];
	
    var minDate = (year +"-"+ month +"-"+ day);
	
    $('#endDate').attr('min',minDate); 
    $('#endDate').attr('disabled',false); 

  });
});

			</script>
        </div>
    </div>
        <!-- /page content -->


        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
<?php } else { echo "Not Authorised";} ?>