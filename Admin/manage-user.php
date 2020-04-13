



<?php  include_once'template/header.php';?>
<?php

if(isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 0)){
		



include_once '../dbCon.php';
$conn = connect();
$sql = "select * from users ";
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
                   <h1 style="text-align:center";>Manage-user</h1>
				   <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
						<h4 class="text-center text-danger"><?php
                        if (isset($_SESSION['msgerror'])) {
                            echo $_SESSION['msgerror'];
                            unset($_SESSION['msgerror']);
                        }
                        ?></h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                          
                            <th>user ID</th>
                            <th>User name</th>
                            <th>User Email</th>
                            <th>Department id</th>
                            <th>Role</th>
                           
                          
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach($result as $row){?>
                        <tr class="odd gradeX">
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['department_id']?></td>
                            <td><?php if($row['role']==1){
								echo "student";
								}elseif($row['role']==2){
									echo "manager";}elseif($row['role']==0){
										echo "Admin";}elseif($row['role']==3){
											echo "Co-Ordinator";} ?></td>
						
                            <td>
									 
                                    <a href="edit-user.php?id=<?php echo $row['id']?>" class="btn btn-info btn-xs" title="Edit User">
                                        <span class="glyphicon glyphicon-edit"> Edit</span>
                                    </a>
									<a href="delete-user.php?id=<?php echo $row['id']?>" id="not" class="btn btn-danger btn-xs" Onclick="myFunction();" title="Delete User">
                                        <span class="glyphicon glyphicon-trash"> Delete</span>
                                    </a>
	
                                  
                            </td>
							
					
                        </tr>
						<?php }?>
                        </tbody>
						<script>
						function myFunction(){
							var con;
							con=confirm('Are you sure to delete the user!!!!!');
							if(con==true){
								alert('deleted');
							}else{
									return false;
							}
							
						}
						
						document.forms['editUserForm'].elements['role'].value = '<?php echo row['roles']; ?>';
						</script>
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