<?php session_start()?>
<?php include_once'Mastering/header.php'; ?>
<?php
if (!isset($_SESSION['user_role'])){
	header('location:login.php');
}
?>

<?php
include_once 'dbCon.php';
$conn = connect();
$sql = "SELECT * FROM `categories` WHERE CURDATE() BETWEEN start_date AND end_date";
$result = $conn->query($sql);
 
?>



    <!-- Navigation -->
<?php include 'Mastering/nav-bar.php'; ?>
    <!-- Page Content -->
    <div class="container">

      <div class="row">
	  <!-- Sidebar Widgets Column -->
	  <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">User Report </h5>
			
            <div class="card-body">
			<div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png" alt="Avatar" title="Change the avatar">
                        </div>
						
                      </div>
              <h3>Personal Info</h3>
					   <form class="form-horizontal">
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">ID</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Name</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Department</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group" style=" font-size:14px;">
								<label class="col-sm-4">Email</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control"/>
								</div>
							</div>
					
						</form>
                      <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />
            </div>
          </div>

         </div>

        <!-- Post Content Column -->
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
                            <ul class="messages">
                              <li>
                                
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon="?"></span>
                                   
                                  </p>
                                </div>
                              </li>
                              
                            </ul>
                            <!-- end recent activity -->

                          </div>
                          
                        </div>
                      </div>
                    </div>

        
        

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  <!-- Footer -->
  <?php include_once'Mastering/footer.php';?>
  <?php include_once'Mastering/foot-scripts.php';?>


