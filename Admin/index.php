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

//number of contributors of BIT department

$sql="SELECT ideas.students_id  FROM `ideas`,users WHERE ideas.students_id=users.id AND users.department_id=1 GROUP BY ideas.students_id";
$result=$conn->query($sql);
$BitContributors=mysqli_num_rows($result);



//number of contributors of CSE department

$sql="SELECT ideas.students_id  FROM `ideas`,users WHERE ideas.students_id=users.id AND users.department_id=2 GROUP BY ideas.students_id";
$CSEContributor=$conn->query($sql);
$ContributorsCSE=mysqli_num_rows($CSEContributor);

//number of contributors of IT department

$sql="SELECT ideas.students_id  FROM `ideas`,users WHERE ideas.students_id=users.id AND users.department_id=3 GROUP BY ideas.students_id";
$ITContributor=$conn->query($sql);
$ContributorsIT=mysqli_num_rows($ITContributor);


//number of contributors of EEE department

$sql="SELECT ideas.students_id  FROM `ideas`,users WHERE ideas.students_id=users.id AND users.department_id=4 GROUP BY ideas.students_id";
$EEEContributor=$conn->query($sql);
$ContributorsEEE=mysqli_num_rows($EEEContributor);

//Total contributors

$totalContributors=$BitContributors+$ContributorsCSE+$ContributorsIT+$ContributorsEEE;


//Idea Without Comment
$sql="SELECT id FROM ideas WHERE id NOT IN (SELECT idea_id FROM comments) AND publication_status=1;";
$IdeaNocomment=$conn->query($sql);
$Nocomment=mysqli_num_rows($IdeaNocomment);

//anonymous Post
$sql="select id from ideas where anonymous_post=1";
$anonymousPost=$conn->query($sql);
$anonymousPost=mysqli_num_rows($anonymousPost);
//anonymous Comment
$sql="select id from comments where anonymous_comment=1";
$anonymouscomment=$conn->query($sql);
$anonymouscomment=mysqli_num_rows($anonymouscomment);

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
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> BIT Contributors</span>
              <div class="count" style="text-align:center;"><?=$BitContributors?></div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> CSE Contributors</span>
              <div class="count" style="text-align:center;"><?=$ContributorsCSE?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> IT Contributors</span>
              <div class="count green" style="text-align:center;"><?=$ContributorsIT?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> EEE Contributors</span>
              <div class="count" style="text-align:center;"><?=$ContributorsEEE?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count" style="text-align:center;"><?=$totalContributors?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
              </div>
          <!-- /top tiles -->

          <div class="row">
             <br />

          <div class="row">

<!--NUmber of ideas-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Number of ideas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>Each Deparment ideas</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>BIT</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$b?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>CSE</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$C?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>IT</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$I?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>EEE</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$E?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                
                </div>
              </div>
            </div>
<!-- Department percentage-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Percentage of ideas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Each Department</p>
                      </th>
                      <th>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px;padding:0px;">
                          <p class="">Deparment View</p>
                        </div>
                        
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>BIT</p>
                            </td>
                            <td><?=$BITTotal?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>CSE </p>
                            </td>
                            <td><?=$CSETotal?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>IT </p>
                            </td>
                            <td><?=$ITTotal?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>EEE </p>
                            </td>
                            <td><?=$EEETotal?>%</td>
                          </tr>
                         
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

<!--Ideas without comment-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Specific Reports</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                   <h4>Ideas Without Comment :<span><b><?=$Nocomment?></b></span></h4>
                   <h4>Anonymous Post :<span><b><?=$anonymousPost?></b></span></h4>
                   <h4>Anonymous Comment :<span><b><?=$anonymouscomment?></b></span></h4>

                </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
      <?php include_once'template/footer.php';?>
	   <!-- foot-scripts content -->
      <?php include_once'template/foot-scripts.php';?>