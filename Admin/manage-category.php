



<?php  include_once'template/header.php';?>
<?php

if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 0)){
		



include_once '../dbCon.php';
$conn = connect();
$sql = "select * from categories ";
$result = $conn->query($sql);

 
?>
   <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Tahsin!</span></a>
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
		 <div class="row" style="Padding-left:250px";>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" >
                   <h1 style="text-align:center";>Manage-category</h1>
				   <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                          
                            <th>Category ID</th>
                            <th>Category name</th>
                            <th>Category description</th>
                            <th>Start date</th>
                            <th>End date</th>
                          
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach($result as $row){?>
                        <tr class="odd gradeX">
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['description']?></td>
                            <td><?=$row['start_date']?></td>
                            <td><?=$row['end_date']?></td>
						
                            <td>
									 
                                    <a href="edit-category.php?id=<?php echo $row['id']?>" class="btn btn-info btn-xs" title="Edit Category">
                                        <span>Edit</span>
                                    </a>
									<?php 
									$id=$row['id'];
										$sqldel="SELECT categories.id FROM categories Where categories.id NOT IN (Select categories_id from ideas) AND categories.id='$id'";
										$resdel= $conn->query($sqldel);
										$resdel=mysqli_num_rows($resdel);
										if($resdel==1){
									?>
									
                                  <a href="delete-category.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-xs" title="Delete Category">
                                        <span>Delete</span>
                                    </a>
										<?php } ?>
                            </td>
					
                        </tr>
						<?php }?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

		 <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
	  <?php } else { echo "Not Authorised";} ?>