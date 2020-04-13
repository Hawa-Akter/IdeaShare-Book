



<?php  include_once'template/header.php';?>
<?php

include_once '../dbCon.php';
$conn = connect();
$sql = "select users.*, ideas.* from ideas,users where ideas.students_id =users.id AND department_id=3";
//select users.*, ideas.*, categories.* from ideas,users,categories where ideas.students_id =users.id AND ideas.categories_id=categories.id AND department_id=2

$result = $conn->query($sql);
if($_SESSION['user_role'] ==2||$_SESSION['user_role'] ==0 || ($_SESSION['department']==3 && $_SESSION['user_role'] == 3)){ 

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
                   <h1 style="text-align:center";>IT Department View</h1>
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
                          
                            <th>Idea ID</th>
                            <th>Idea name</th>
                            <th>Category ID</th>
                          
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Role</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach($result as $row){?>
                        <tr class="odd gradeX">
                            <td><?=$row['id']?></td>
                            <td><?=$row['idea_name']?></td>
                            <td><?=$row['categories_id']?></td>
                           
                            <td><?=$row['students_id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['role']==1 ? 'Student':'staff'?></td>
						
                           
					
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