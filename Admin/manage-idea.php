



<?php  include_once'template/header.php';?>
<?php

if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 0)){
	
		include_once '../dbCon.php';
$conn = connect();
if(isset($_POST['update'])){
	
	$id=$_POST['ideaId'];
	$closureDate=$_POST['closureDate'];

	$sql="UPDATE `ideas` SET `closure_date`='$closureDate' WHERE `id`=$id";
	$res=$conn->query($sql);

}



$sql = "select * from ideas ORDER BY id DESC;";
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
		 <div class="row" style="Padding-left:250px";>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" >
                   <h1 style="text-align:center";>Manage-Ideas</h1>
				   <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="width:70%">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                          
                            <th>Idea ID</th>
                            <th>Idea Name</th>
                            <th>idea Details</th>
                            <th>category ID</th>
                            <th>Student ID</th>
                            <th>File</th>
                            <th>Closure Date </th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach($result as $row){?>
                        <tr class="odd gradeX">
                            <td><?=$row['id']?></td>
                            <td><?=$row['idea_name']?></td>
                            <td><?=$row['idea_details']?></td>
                            <td><?=$row['categories_id']?></td>
                            <td><?=$row['students_id']?></td>
							<td><img src="../<?= $row['file_name'] ?>" alt="img" height="70px" width="70px"></td>
							<td>
							  
							  <form action="" method="post">
								<div class="form-group">
								<div class="col-sm-12">
									<input type="date" name="closureDate" class="form-control" value="<?php echo $row['closure_date'];?>"/>
								</div>
								</div>
							 
							  
							  
							</td>
							<td><?=$row['publication_status']?></td>
                            <td>
									<?php if ($row['publication_status']==0){?>
                                    <a href="published-idea.php?id=<?php echo $row['id']?>" class="btn btn-warning btn-xs" title="Published Category">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
									<?php } else{?>
                                    <a href="unpublished-idea.php?id=<?php echo $row['id']?>" class="btn btn-success btn-xs" title="Unpublished Category">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
									
									
                                <?php }?>
								
                               
                                <a href="delete-idea.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-xs" title="Delete Category" onclick="return confirm('Are you sure to delete this'); ">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
								<input type="submit" name="update" class="form-control btn btn-info " value="Update"/>
								<input type="hidden" name="ideaId" class="form-control btn btn-info " value="<?=$row['id']?>"/>
								
                            </td>
							 </form>
						<?php }?>
							
                        </tr>
                       
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