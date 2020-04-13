
<?php  include_once'template/header.php';?>
<?php 

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0){ 
include_once '../dbCon.php';
    $conn = connect();
	$sql="Select users.*, department.department_name from users,department where users.department_id=department.id AND users.role=3";
	$coordinators=$conn->query($sql);
	$sqli="SELECT * FROM department Where id NOT IN (Select department_id from users)";
	$departments=$conn->query($sqli);
	$sqlp="select * from users where department_id=6";
	$coordinator=$conn->query($sqlp);
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

               <h1 style="text-align:center;">Add New Coordinator</h1>
					 <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                <form action="" method="POST" class="form-horizontal">
                   
                 
					<div class="form-group">
                        <label class="col-sm-3">Coordinator Name</label>
                        <div class="col-sm-9">
                            <select required name="coordinator" id="coordinator" class="form-control" style="height:40px;">
                                <option>---Select Coordinator---</option>
								<?php foreach($coordinator as $row){?>
                                <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                <?php } ?>
                  
                                
                            </select>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3">Department</label>
                        <div class="col-sm-9">
                            <select required name="department" id="department" class="form-control" style="height:40px;">
                                <option>---Select department---</option>
								<?php foreach($departments as $row){?>
                                <option value="<?=$row['id']?>"><?=$row['department_name']?></option>
                                <?php } ?>
                  
                                
                            </select>
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
	<div class="row">
		   <!-- /.panel-heading -->
		   <div class="col-md-offset-3 col-md-9" style="background-color:white">
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<h4 style="text-align:center;">Coordinator In Department</h4>
                        <thead>
                        <tr>
                          
                            <th>user ID</th>
                            <th>User name</th>
                            <th>User Email</th>
                            <th>Department id</th>
                     
                           
                          
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                      
                        <?php foreach($coordinators as $row){?>
                        <tr class="odd gradeX">
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['department_name']?></td>
                           <td>
									 
                                    <a href="edit-user.php?id=<?php echo $row['id']?>" class="btn btn-info btn-xs" title="Edit User">
                                        <span class="glyphicon glyphicon-edit"> Edit</span>
                                    </a>
								
	
                                  
                            </td>
							
					
                        </tr>
						<?php }?>
                        </tbody>
						</div>
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
        <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
	  <?php } else { echo "Not Authorised";} ?>