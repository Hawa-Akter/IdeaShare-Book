<?php session_start()?>

<?php include_once'Mastering/header.php'; ?>
<?php
if (!isset($_SESSION['user_role'])){
	header('location:login.php');
}
if(isset($_SESSION['user_role']) && ($_SESSION['user_role']==2 || $_SESSION['user_role']==0)){
	header('location:index.php');
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

        <!-- Post Content Column -->
        <div class="col-lg-8">

        
		 <form id="ideaForm" action="ideaController.php" method="POST" class="form-horizontal" style="border:2px solid #B8D8F9; padding:30px; border-radius:10px; background-image:url(vendor/images/back.jpg)"  enctype="multipart/form-data">
                    <h1 style="color:white;text-align:center; padding-top:0px;padding-bottom:20px;">SHARE IDEA</h1>
					 <h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
                    <div class="form-group" style="color:white; font-size:20px;">
                        <label class="col-sm-3">Idea Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control"/>
							<h4 class="text-danger"><?php if (isset($_SESSION['ideaError'])) {echo ($_SESSION['ideaError']);unset ($_SESSION['ideaError']);}?></h4>
                        </div>
                    </div>
					<div class="form-group"style="color:white; font-size:20px;">
                        <label class="col-sm-3">Idea Details</label>
                        <div class="col-sm-9">
                            <input type="text" name="ideaDetails" class="form-control"/>
							<h4 class="text-danger"><?php if (isset($_SESSION['ideaDetailsError'])) {echo ($_SESSION['ideaDetailsError']);unset ($_SESSION['ideaDetailsError']);}?></h4>
                        </div>
                    </div>
					<div class="form-group"style="color:white; font-size:20px;">
                        <label class="col-sm-3">Category</label>
                        <div class="col-sm-9">
                            <select name="categories" class="form-control" style="height:40px;">
                                <option value="">---Select Category Status---</option>
								<?php foreach($result as $row){?>
                                <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                <?php } ?>
                            </select>
							<h4 class="text-danger"><?php if (isset($_SESSION['categoriesError'])) {echo ($_SESSION['categoriesError']);unset ($_SESSION['categoriesError']);}?></h4>
                      
                        </div>
                    </div>
					<div class="form-group"style="color:white; font-size:20px;">
                        <label class="col-sm-3">File</label>
                        <div class="col-sm-9">
                            <input type="file" name="file"  class="form-control"/>
                        </div>
                    </div>
					
					<div class="form-group"style="color:white; font-size:20px;">
                        <label><input type="checkbox" value="" required="required"/>Terms & Condition</label>
                      
                    </div>
					<div class="form-group"style="color:white; font-size:20px;">
                        <label><input type="checkbox" name="anonymousPost" value="1">Anonimous Post</label>
                      
                    </div>
                    <div class="form-group"style="color:white; font-size:20px;">
                        <div class="col-sm-9 col-sm-offset-3">
                            
							<div class="col-sm-6">
								<input type="submit" name="submit" class="btn btn-info btn-block" value="Submit"/>
							</div>
							<div class="col-sm-6">
								<input type="button" name="" class="btn btn-danger btn-block" onclick="myFunction();" value="Cancel"/>
							</div>
                        </div>
                    </div>
                    
                </form>
			<script>
			
			function myFunction() {
    document.getElementById("ideaForm").reset();
}
</script>
			</script>

        </div>

        <div class="col-md-4">        <!-- Sidebar Widgets Column -->


          <!-- Categories Widget -->
		  <?php include_once'Mastering/side-bar.php';?>
          <!-- Side Widget -->
         </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  <!-- Footer -->
  <?php include_once'Mastering/footer.php';?>
  <?php include_once'Mastering/foot-scripts.php';?>


