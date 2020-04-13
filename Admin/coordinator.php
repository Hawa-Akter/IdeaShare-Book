
<?php  include_once'template/header.php';?>
<?php

include_once '../dbCon.php';
$conn = connect();
$sql = "SELECT count(ideas.id) AS 'BITIdeas' FROM `ideas`,users WHERE ideas.students_id=users.id AND department_id=1;";
$IdeaOfBIT = $conn->query($sql);
$BIT=mysqli_fetch_assoc($IdeaOfBIT);
$b=$BIT['BITIdeas'];

//Total ideas
$totalIDeas = "SELECT count(ideas.id) AS 'TotalIdea' FROM `ideas`;";
$TotalIdeas = $conn->query($totalIDeas);
$Total=mysqli_fetch_assoc($TotalIdeas);
$T=$Total['TotalIdea'];

$percentageOfBIT=(($b/$T)*100);
$BITTotal=number_format((float)$percentageOfBIT, 1, '.', '');


//2nd department
$sql = "SELECT count(ideas.id) AS 'CSEIdeas' FROM `ideas`,users WHERE ideas.students_id=users.id AND department_id=2;";
$IdeaOfCSE = $conn->query($sql);
$CSE=mysqli_fetch_assoc($IdeaOfCSE);
$C=$CSE['CSEIdeas'];

$percentageOfCSE=(($C/$T)*100);
$CSETotal=number_format((float)$percentageOfCSE, 1, '.', '');


//3rd department
$sql = "SELECT count(ideas.id) AS 'ITIdeas' FROM `ideas`,users WHERE ideas.students_id=users.id AND department_id=3;";
$IdeaOfIT = $conn->query($sql);
$IT=mysqli_fetch_assoc($IdeaOfIT);
$I=$IT['ITIdeas'];

$percentageOfIT=(($I/$T)*100);
$ITTotal=number_format((float)$percentageOfIT, 1, '.', '');

//4th department
$sql = "SELECT count(ideas.id) AS 'EEEIdeas' FROM `ideas`,users WHERE ideas.students_id=users.id AND department_id=4;";
$IdeaOfEEE = $conn->query($sql);
$EEE=mysqli_fetch_assoc($IdeaOfEEE);
$E=$EEE['EEEIdeas'];

$percentageOfEEE=(($E/$T)*100);
$EEETotal=number_format((float)$percentageOfEEE, 1, '.', '');

if($_SESSION['user_role'] ==3 && $_SESSION['department']!=0 ){ 
?>

   <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span> <?php echo $_SESSION['username']; ?></span></a>
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
		 <h1 style="text-align:center;">WELCOME CO-ORDINATOR</h1>
        <!-- /.col-lg-12 -->
		 <div class=" col-sm-offset-3 col-sm-6 col-sm-offset-3">
			<div class="row" style="background-color:white; height:200px;">
			<div class="panel panel-heading panel-primary" style="background-color:#E5F3FB">
			<h3 style="text-align:center;">DEPARTMENT IDEA PERCENTAGE</h3>
			</div>
			<?php if($_SESSION['department']==1){ ?>
					<div class="col-sm-6" style="border-right:2px solid black;"><h1 style="text-align:center">BIT<h1></div>
					<div class="col-sm-6"><h1 style="text-align:center"><?php echo $BITTotal; ?>%</h1></div>
			<?php }; ?>
			<?php if($_SESSION['department']==2){ ?>
					<div class="col-sm-6" style="border-right:2px solid black;"><h1 style="text-align:center">CSE<h1></div>
					<div class="col-sm-6"><h1 style="text-align:center"><?php echo $CSETotal; ?>%</h1></div>
			<?php }; ?>
			<?php if($_SESSION['department']==3){ ?>
					<div class="col-sm-6" style="border-right:2px solid black;"><h1 style="text-align:center">IT<h1></div>
					<div class="col-sm-6"><h1 style="text-align:center"><?php echo $ITTotal; ?>%</h1></div>
			<?php }; ?>
			<?php if($_SESSION['department']==4){ ?>
					<div class="col-sm-6" style="border-right:2px solid black;"><h1 style="text-align:center">EEE<h1></div>
					<div class="col-sm-6"><h1 style="text-align:center"><?php echo $EEETotal; ?>%</h1></div>
			<?php }; ?>
			</div>
			
		 </div>
                
    </div>

		 <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>
<?php } else { echo "Not Authorised";} ?>
	